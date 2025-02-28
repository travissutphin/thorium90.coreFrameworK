<?php
// Cache configuration
$cacheConfig = [
    'enabled' => true,
    'directory' => __DIR__ . '/cache',
    'duration' => 3600 // Cache duration in seconds (1 hour)
];

/**
 * Get cache filename for a slug
 * 
 * @param string $slug Page slug
 * @return string Cache filename
 */
function getCacheFilename($slug) {
    global $cacheConfig;
    return $cacheConfig['directory'] . '/page_' . md5($slug) . '.cache';
}

/**
 * Get page from cache
 * 
 * @param string $slug Page slug
 * @return array|null Cached page data or null if not found/expired
 */
function getPageFromCache($slug) {
    global $cacheConfig;
    
    if (!$cacheConfig['enabled']) {
        return null;
    }

    $cacheFile = getCacheFilename($slug);
    
    if (file_exists($cacheFile)) {
        $content = file_get_contents($cacheFile);
        $data = unserialize($content);
        
        // Check if cache is still valid
        if ($data['expires'] > time()) {
            return $data['page'];
        }
        
        // Cache expired, delete it
        unlink($cacheFile);
    }
    
    return null;
}

/**
 * Save page to cache
 * 
 * @param string $slug Page slug
 * @param array $pageData Page data to cache
 * @return bool Success status
 */
function savePageToCache($slug, $pageData) {
    global $cacheConfig;
    
    if (!$cacheConfig['enabled']) {
        return false;
    }

    // Ensure cache directory exists
    if (!is_dir($cacheConfig['directory'])) {
        mkdir($cacheConfig['directory'], 0777, true);
    }

    $cacheFile = getCacheFilename($slug);
    
    $data = [
        'expires' => time() + $cacheConfig['duration'],
        'page' => $pageData
    ];
    
    return file_put_contents($cacheFile, serialize($data)) !== false;
}

/**
 * Clear cache for a specific page
 * 
 * @param string $slug Page slug
 * @return bool Success status
 */
function clearPageCache($slug) {
    $cacheFile = getCacheFilename($slug);
    if (file_exists($cacheFile)) {
        return unlink($cacheFile);
    }
    return true;
}

/**
 * Clear entire page cache
 * 
 * @return bool Success status
 */
function clearAllPageCache() {
    global $cacheConfig;
    
    $files = glob($cacheConfig['directory'] . '/page_*.cache');
    foreach ($files as $file) {
        unlink($file);
    }
    return true;
}

// Example usage with the previous page code:
$slug = $_GET['slug'] ?? 'home';

// Try to get page from cache first
$page = getPageFromCache($slug);

if (!$page) {
    // If not in cache, get from database
    $pdo = getDbConnection();
    if ($pdo) {
        $page = getPage($pdo, $slug);
        if ($page) {
            // Save to cache for next time
            savePageToCache($slug, $page);
        }
    }
}

// Rest of your page display code...