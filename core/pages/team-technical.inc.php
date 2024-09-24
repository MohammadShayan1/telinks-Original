<?php
global $sql;
// Fetch images from the database
$query = $sql->query("SELECT name, position, tenure, linkedin, profile_picture FROM teamtech");

// Initialize an empty array to store the members
$teamtech = [];

// Fetch all members using fetch_assoc in a loop
while ($row = $sql->fetch_assoc($query)) {
    $teamtech[] = $row;
}
?>

<style>
    .member-card {
        margin-bottom: 40px;
        border: 1px solid #ddd;
        border-radius: 20px;
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

<main>
    <section>
        <div class="container">
            <h1 class="text-center my-5 pt-5">Team Technical</h1>
            <div class="row">
                <?php foreach ($teamtech as $member): ?>
                    <div class="col-md-3">
                        <div class="card member-card">
                            <img src="./<?php echo htmlspecialchars($member['profile_picture']); ?>" class="profile-img card-img-top" alt="<?php echo htmlspecialchars($member['name']); ?>">
                            <div class="member-info card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($member['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($member['position']); ?></p>
                                <p class="card-text"><small class="text-muted">Tenure: <?php echo htmlspecialchars($member['tenure']); ?></small></p>
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
