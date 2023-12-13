<?php
require "../db/connection.php";
session_start();
$userid = $_SESSION['userid'];



function cleanText($text) {
    // Convert text to lowercase
    $text = strtolower($text);

    // Remove punctuation
    $text = preg_replace("/[[:punct:]]+/", " ", $text);
    $text = preg_replace("/\d+/", "", $text);

    // Define stopwords
    $stopwords = ["a", "an", "and", "are", "as", "at", "be", "by", "for", "from", "has", "he", "in", "is", "it", "its", "of", "on", "that", "the", "to", "was", "were", "will", "with"];

    // Remove stopwords
    $tokens = explode(" ", $text);
    $tokens = array_filter($tokens, function($word) use ($stopwords) {
        return !in_array($word, $stopwords);
    });

    // Reconstruct the text
    $text = implode(" ", $tokens);

    return $text;
}

function computeTF($document, $term) {
    $count = 0;
    $words = explode(' ', $document);
    foreach ($words as $word) {
        if ($word == $term) {
            $count++;
        }
    }
    return $count / count($words);
}

function computeIDF($documents, $term) {
    $N = count($documents);
    $docsWithTerm = 0;
    foreach ($documents as $doc) {
        if (strpos($doc, $term) !== false) {
            $docsWithTerm++;
        }
    }
    if (!empty($term) && $docsWithTerm == 0) return 0;
    return log($N / $docsWithTerm);
}


function getEuclideanDistance($docScores, $recentDocScores) {
    $sum = 0;
    foreach ($docScores as $term => $score) {
        $recentScore = $recentDocScores[$term] ?? 0;
        $sum += pow($score - $recentScore, 2);
    }
    return sqrt($sum);
}



// Fetch user's commented articles
$documents = [];
$query = "SELECT n.introduction, n.description FROM news n JOIN comments c ON n.newsid = c.newsid WHERE c.userid = '$userid'";
$result = mysqli_query($conn, $query);
$concatenatedDocument = ''; // Initialize concatenated document

if ($result) {
    while ($newsRow = mysqli_fetch_array($result)) {
        $cleaned = cleanText($newsRow['introduction'].$newsRow['description']); 
        $concatenatedDocument .= ' ' . $cleaned;
    }
} else {
    echo "No recently commented news found.<br>";
}

$concatWords = explode(' ', $concatenatedDocument);
$concatTfidfScores = [];

foreach ($concatWords as $word) {
    $tf = computeTF($concatenatedDocument, $word);
    $idf = computeIDF([$concatenatedDocument], $word);
    $concatTfidfScores[$word] = $tf * $idf;
}

// Fetch recent news articles
$recentNews = [];
$recentQuery = "SELECT newsid, introduction, description FROM news WHERE date >= NOW() - INTERVAL 30 DAY ORDER BY date DESC";  // Assuming there's a date column
$recentResult = mysqli_query($conn, $recentQuery);
if ($recentResult) {
    while ($newsRow = mysqli_fetch_array($recentResult)) {
        $cleaned = cleanText($newsRow['introduction'].$newsRow['description']);
        $recentNews[] = ['id' => $newsRow['newsid'], 'text' => $cleaned];
    }
}

// Compute the TF-IDF scores for recent news articles
$recentNewsTFIDFScores = [];
foreach ($recentNews as $newsItem) {
    $words = explode(' ', $newsItem['text']);
    $tfidfScores = [];
    foreach ($words as $word) {
        $tf = computeTF($newsItem['text'], $word);
        $idf = computeIDF(array_merge($documents, array_column($recentNews, 'text')), $word);
        $tfidfScores[$word] = $tf * $idf;
    }
    $recentNewsTFIDFScores[] = ['id' => $newsItem['id'], 'scores' => $tfidfScores];
}


// Compute distances between concatenated user document and recent news articles
$docScores = $concatTfidfScores;

// echo "Comparing User's Comments with Recent News:<br>";

$distances = [];
foreach ($recentNewsTFIDFScores as $recentIndex => $recentScoresItem) {
    $distance = getEuclideanDistance($docScores, $recentScoresItem['scores']);
    $distances[] = ['distance' => $distance, 'id' => $recentScoresItem['id']];
}

// Sort by distance
usort($distances, function($a, $b) {
    return $a['distance'] <=> $b['distance'];
});

// Display top 3 distances
for ($i = 0; $i < min(3, count($distances)); $i++) {
    // echo "Top " . ($i + 1) . ": ";
    // echo "Distance to Recent News Article with ID " . $distances[$i]['id'] . ": " . $distances[$i]['distance'] . "<br>";
    $recommendationResult[] = $distances[$i]['id'];
}

// echo "<hr>";
// print_r($recommendationResult);

?>