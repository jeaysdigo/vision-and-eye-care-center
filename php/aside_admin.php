<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- <link rel="stylesheet" href="css/fontawesome.css">
<script src="js/fontawesome.min.js"></script> -->

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 flex flex-col flex-grow">
        <ul class="space-y-2 font-medium flex-grow">
            <li>
                <a href="admin.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-table-columns text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin_bookings.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-calendar-check text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Appointments</span>
                </a>
            </li>
            <li>
                <a href="admin_records.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-folder-open text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Medical Records</span>
                </a>
            </li>
            <li>
                <a href="admin_services.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-briefcase-medical text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Clinic Services</span>
                </a>
            </li>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <li>
                <a href="admin_doctors.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-user-md text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Doctors</span>
                </a>
            </li>
            <li>
                <a href="admin_patients.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-users text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Patients</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="px-3 pb-4 font-medium ">
        <a href="settings.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <i class="fas fa-cog text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
        </a>
        <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <i class="fas fa-sign-out-alt text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
        </a>
    </div>
</aside>
