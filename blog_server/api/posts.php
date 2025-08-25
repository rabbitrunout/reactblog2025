<?php 
    header("Content-Type: application/json");

    // Load configuration files
    require_once('../config/config.php');
    require_once('../config/database.php');

    // Define configuration options
    $allowedMethodts = ['GET'];
    $maxPostsPage = 4;

    // Implement basic pagination
    $page = isset($_GET['page']) ?(int) $_GET['page'] : 1;
    $offset = ($page - 1) * $maxPostsPage;

    // Query to count total posts
    $countQuery = "SELECT COUNT(*) AS totalPosts FROM blog_posts";
    $countResult = mysqli_query($conn, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $totalPosts = $countRow['totalPosts'];

    // Check if total posts query is successful
    if (!$countResult)
    {
        http_response_code(500); //internal server error
        echo json_encode(['message' => 'Error query in database for total
                posts count: '. mysqli_error($conn)]);
        mysqli_close($conn);
        exit();
    }

    //Query to get all blog posts with pagination and ordering
    $query = "SELECT * FROM blog_posts ORDER BY publish_date DESC LIMIT $offset, $maxPostsPage";
    $result = mysqli_query($conn, $query);

    // Check if total post posts query is successful
     if (!$result)
    {
        http_response_code(500); //internal server error
        echo json_encode(['message' => 'Error query in database for total
                posts: '. mysqli_error($conn)]);
        mysqli_close($conn);
        exit();
    }

    // Convert query result into an associative array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Check if there posts
    if (empty($posts))
    {
        http_response_code(404);// not found error
        echo json_encode(['message' => 'No posts found', 'totalPosts' => $totalPosts ]);
    }
    else
    {
        // return JSON response including totalPosts
        echo json_encode(['posts' => $posts, 'totalPosts' => $totalPosts ]);
    }

    // Close database connection
    mysqli_close($conn);



?>