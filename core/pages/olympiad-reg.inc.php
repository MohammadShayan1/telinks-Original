<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

global $sql;
// Assuming this is the SQL class you're using
$sql = new sql(); // Or however the connection is created

// Initialize registration success flag
$registration_success = false;

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Input validation for form fields
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $roll_no = filter_input(INPUT_POST, 'roll_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $contact_no = filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Capture gender
    $interest = isset($_POST['interest']) ? implode(", ", array_map('htmlspecialchars', $_POST['interest'])) : '';
    $experience = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $commitment = isset($_POST['commitment']) ? implode(", ", array_map('htmlspecialchars', $_POST['commitment'])) : '';
    $merch = filter_input(INPUT_POST, 'merch', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $rules = filter_input(INPUT_POST, 'rules', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM olympiad_registrations WHERE email = ?";
    $stmt = $sql->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email is already registered
        $_SESSION['error_message'] = 'The provided email is already registered for Olympiad 4.0.';
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }
    
    $stmt->close();

    // Handle file upload for ID card, saving it with the roll number as the filename
    if (isset($_FILES['id_card']) && $_FILES['id_card']['error'] === UPLOAD_ERR_OK) {
        // Directory where the file will be uploaded
        $target_dir = "uploads/olympiad/";
        // Ensure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Get the file extension and validate it
        $file_extension = strtolower(pathinfo($_FILES['id_card']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        if (!in_array($file_extension, $allowed_extensions)) {
            $_SESSION['error_message'] = 'Invalid file type. Only JPG, JPEG, and PNG files are allowed.';
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit();
        }

        // Save the file with the roll number as the filename
        $target_file = $target_dir . $roll_no . "." . $file_extension;
        if (!move_uploaded_file($_FILES['id_card']['tmp_name'], $target_file)) {
            $_SESSION['error_message'] = 'Error uploading file.';
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'No file uploaded or there was an upload error.';
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    // Save the form data into the database
    $query = "INSERT INTO olympiad_registrations (name, roll_no, department, gender, email, contact_no, interest, experience, commitment, id_card, merch, rules)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $sql->prepare($query);
    $stmt->bind_param('ssssssssssss', $name, $roll_no, $department, $gender, $email, $contact_no, $interest, $experience, $commitment, $target_file, $merch, $rules);

    if ($stmt->execute()) {
        $registration_success = true;
    } else {
        $_SESSION['error_message'] = 'Error processing your registration. Please try again later.';
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }

    $stmt->close();
}
?>

<link rel="stylesheet" href="./gui/css/olympiad-reg.css">
<main>
    <header class="header">
        <div class="header-content">
            <h1 class="heading font-weight-bold">OLYMPIAD 4.0</h1>
        </div>
    </header>

    <div class="container my-5">
        <!-- Display the success message if the registration was successful -->
        <?php if ($registration_success): ?>
            <div class="alert alert-success" role="alert">
                Registration successful! Thank you for signing up for Olympiad 4.0.
            </div>
        <?php endif; ?>

        <!-- Display error message if there's any -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>

        <!-- Form container with card-like structure for each field -->
        <div class="form-container">
            <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <!-- Full Name -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="name" class="form-label required-field">Full Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                    </div>
                </div>

                <!-- Roll No -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="roll_no" class="form-label required-field">Roll No (e.g., TC-21022):</label>
                        <input type="text" class="form-control" name="roll_no" placeholder="Enter your roll number" required>
                    </div>
                </div>

                <!-- Department -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="department" class="form-label required-field">Department:</label>
                        <input type="text" class="form-control" name="department" placeholder="Enter your department" required>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="email" class="form-label required-field">Email Address:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="contact_no" class="form-label required-field">Contact No:</label>
                        <input type="text" class="form-control" name="contact_no" placeholder="Enter your contact number" required>
                    </div>
                </div>

                <!-- Gender -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="gender" class="form-label required-field">Gender:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Male" required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="Female" required>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                </div>

                <!-- Interest -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="interest" class="form-label required-field">Choose Game of Your Interest:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Cricket">
                        <label class="form-check-label">Cricket</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Football">
                        <label class="form-check-label">Football</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Volleyball">
                        <label class="form-check-label">Volleyball</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Relay Race">
                        <label class="form-check-label">Relay Race</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Badminton">
                        <label class="form-check-label">Badminton</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="100M Sprint">
                        <label class="form-check-label">100M Sprint</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Table Tennis">
                        <label class="form-check-label">Table Tennis</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Arm Wrestling">
                        <label class="form-check-label">Arm Wrestling</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Tug of war">
                        <label class="form-check-label">Tug of war</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="interest[]" value="Chess">
                        <label class="form-check-label">Chess</label>
                    </div>
                </div>
                </div>

                <!-- Experience -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="experience" class="form-label">Past Experience in the Game:</label>
                        <input type="text" class="form-control" name="experience" placeholder="Describe any past experience (optional)">
                    </div>
                </div>

                <!-- Merch Interest -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="merch" class="form-label required-field">Are You Interested in Purchasing TE Link's Merch for Olympiad?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="merch" value="Yes" required>
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="merch" value="No">
                            <label class="form-check-label">No</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="merch" value="Maybe">
                            <label class="form-check-label">Maybe</label>
                        </div>
                    </div>
                </div>

                <!-- ID Card Upload -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="id_card" class="form-label required-field">Upload Your NED's ID Card Picture:</label>
                        <input type="file" class="form-control" name="id_card" required>
                    </div>
                </div>

                <!-- Commitment -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="commitment" class="form-label required-field">Commitment:</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="commitment[]" value="I commit to being available" id="commitment-checkbox1">
                            <label class="form-check-label">I commit to being available at the scheduled times for practice sessions, qualifying rounds, and the main event.</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="commitment[]" id="commitment-checkbox2" value="I understand the importance of punctuality">
                            <label class="form-check-label">I understand the importance of my punctuality and participation to avoid inconvenience to the organizing committee and fellow participants.</label>
                        </div>
                    </div>
                </div>

                <!-- Rules Acknowledgement -->
                <div class="card mb-3">
                    <div class="card-body">
                        <label for="rules" class="form-label required-field">Acknowledgement of Rules:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rules" value="I agree to follow all rules" id="rules-checkbox">
                            <label class="form-check-label">I hereby agree to follow all rules, regulations, and SOPs of the Olympiad while playing under TE-Links's forum.</label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="d-grid">
                        <button class="btn" style="background-color : #0a1b36; color : white;" type="submit">Register</button>
                    </div>
            </form>
        </div>
    </div>
</main>

<script>
// Form validation to ensure that both commitment checkboxes and the rules checkbox are checked
function validateForm() {
    let commitmentChecked1 = document.getElementById('commitment-checkbox1').checked;
    let commitmentChecked2 = document.getElementById('commitment-checkbox2').checked;
    let rulesChecked = document.getElementById('rules-checkbox').checked;

    if (!commitmentChecked1 || !commitmentChecked2 || !rulesChecked) {
        alert("Please make sure you have checked both the Commitment checkboxes and the Acknowledgement of Rules checkbox.");
        return false;
    }

    return true;
}
</script>
