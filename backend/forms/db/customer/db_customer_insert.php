<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex flex-col items-center justify-center p-12 min-h-screen bg-[#F8F9FA]">

    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-[2.5rem] overflow-hidden border border-gray-100">

        <div class="bg-[#0A090C] p-10 flex flex-col items-center justify-center relative">
            <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center border border-white/20 mb-4 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-2xl font-black tracking-tighter text-white italic uppercase">
                Insertion <span class="text-gray-400 not-italic font-light">Protocol Result</span>
            </h1>
        </div>

        <div class="p-10 text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-4">System Status Report</p>

            <?php
            $insert_output = "ERROR: Customer data is missing or incomplete (Form not submitted).";
            $message_class = "bg-red-50 border-red-500 text-red-700";
            $success = false;
            $customer_id_inserted = null;

            // Post variables
            $customer_username = $_POST['customer_username'] ?? 'N/A';
            $customer_user_password = $_POST['customer_user_password'] ?? null;
            $customer_dni = $_POST['customer_dni'] ?? 'N/A';
            $customer_email = $_POST['customer_email'] ?? 'N/A';
            $customer_forename = $_POST['customer_forename'] ?? 'N/A';
            $customer_surname = $_POST['customer_surname'] ?? 'N/A';
            $customer_birth_date = $_POST['customer_birth_date'] ?? 'N/A';
            $customer_registered = $_POST['customer_registered'] ?? '0';
            $customer_active = $_POST['customer_active'] ?? '0';

            if (isset($_POST['send']) && $customer_user_password !== null) {
                include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

                $safe_customer_email = mysqli_real_escape_string($conn, $customer_email);
                $safe_customer_username = mysqli_real_escape_string($conn, $customer_username);
                $safe_hashed_password = mysqli_real_escape_string($conn, $customer_user_password); 

                $sqlRegisterCheck = "SELECT id_customer FROM 022_customers WHERE email = '$safe_customer_email' OR username = '$safe_customer_username'";
                $sqlRegisterCheckResult = mysqli_query($conn, $sqlRegisterCheck);
                
                if (mysqli_num_rows($sqlRegisterCheckResult) > 0) {
                    $insert_output = "CRITICAL ERROR: Duplicate entry detected. The Email or Username already exists.";
                    mysqli_free_result($sqlRegisterCheckResult);
                } else {
                    $safe_customer_dni = mysqli_real_escape_string($conn, $customer_dni);
                    $safe_customer_forename = mysqli_real_escape_string($conn, $customer_forename);
                    $safe_customer_surname = mysqli_real_escape_string($conn, $customer_surname);
                    $safe_customer_birth_date = mysqli_real_escape_string($conn, $customer_birth_date);
                    $safe_customer_registered = mysqli_real_escape_string($conn, $customer_registered);
                    $safe_customer_active = mysqli_real_escape_string($conn, $customer_active);

                    $sql = "INSERT INTO `022_customers` (username, user_password, dni, email, forename, surname, birth_date, registered, active)
                            VALUES ('$safe_customer_username', '$safe_hashed_password', '$safe_customer_dni', '$safe_customer_email', '$safe_customer_forename', '$safe_customer_surname', '$safe_customer_birth_date', '$safe_customer_registered', '$safe_customer_active');";

                    if (mysqli_query($conn, $sql)) {
                        $customer_id_inserted = mysqli_insert_id($conn);
                        $insert_output = "SUCCESS: Customer record for '$customer_forename $customer_surname' has been committed to the database.";
                        $message_class = "bg-green-50 border-green-500 text-green-700";
                        $success = true;
                    } else {
                        $insert_output = "Database Error: " . mysqli_error($conn);
                        $message_class = "bg-red-50 border-red-500 text-red-700";
                    }
                }
                mysqli_close($conn);
            }

            // Status box
            printf("<div class='p-6 border-l-4 %s rounded-2xl mt-4 text-left shadow-sm'>" .
                "<p class='font-black uppercase text-[11px] tracking-widest mb-1'>Log Message</p>" .
                "<p class='text-sm font-bold'>%s</p>" .
                "</div>", $message_class, $insert_output);

            // Result
            if ($success) {
                echo "<div class='mt-10 bg-gray-50 p-8 rounded-[2rem] border border-gray-100'>";
                echo "<p class='text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 text-center'>Inserted Data Summary</p>";
                echo "<div class='grid grid-cols-1 gap-3'>";
                
                $data_fields = [
                    'Reference ID' => $customer_id_inserted,
                    'Username' => $customer_username,
                    'Full Name' => "$customer_forename $customer_surname",
                    'Email' => $customer_email,
                    'Identity DNI' => $customer_dni,
                    'Active Status' => ($customer_active ? 'ENABLED' : 'DISABLED')
                ];

                foreach ($data_fields as $label => $value) {
                    echo "<div class='flex justify-between items-center py-2 border-b border-gray-200/50'>";
                    echo "<span class='text-[10px] font-black uppercase text-gray-400 tracking-tighter'>$label</span>";
                    echo "<span class='text-sm font-bold text-gray-900'>$value</span>";
                    echo "</div>";
                }
                echo "</div></div>";
            }
            ?>

            <div class="mt-10 flex flex-col gap-4">
                <a href="/student022/backend/customers/customers.php"
                    class="w-full p-5 bg-[#0A090C] text-[#FEFFFE] rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl hover:bg-gray-800 transition-all active:scale-[0.98]">
                    Return to Directory
                </a>
            </div>
        </div>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>