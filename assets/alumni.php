<?php

$PageTitle = "TE-Links || Alumni";

function customPageHeader() { ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .member-card {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }
        .profile-img {
            width: 100%;
            height: auto;
        }
        .member-info {
            padding: 20px;
        }
        .linkedin-icon {
            color: #0077b5;
            font-size: 1.5rem;
            margin-right: 10px;
        }
    </style>
<?php }
include '../database/database.php';

// Set the PDO error mode to exception
try {
    // Prepare and execute SQL query
    $sql = "SELECT name, position, tenure, linkedin, profile_picture FROM members";
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        // Fetch all results into an array
        $members = [];
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    } else {
        echo "No Alumni Found";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

include_once('header.php');
?>

<main>
    <section>
        <div class="container">
            <h1 class="text-center my-5 pt-5">Our Former Excom</h1>
            <div class="row">
                <?php foreach ($members as $member): ?>
                    <div class="col-md-3">
                        <div class="card member-card">
                            <img src="vr3rPdHlnK/<?php echo htmlspecialchars($member['profile_picture']); ?>" class="profile-img card-img-top" alt="<?php echo htmlspecialchars($member['name']); ?>">
                            <div class="member-info card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($member['name']); ?></h5>
                                <p class="card-text"><?php echo "Former " . htmlspecialchars($member['position']); ?></p>
                                <p class="card-text"><small class="text-muted"> Tennure: <?php echo htmlspecialchars($member['tenure']); ?></small></p>
                                <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank">
                                    <i class="fab fa-linkedin linkedin-icon"></i> LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php
function customPageFooter() { ?>
    <!-- Arbitrary HTML Tags -->
<?php }
include_once('footer.php');
?>
