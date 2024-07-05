-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 12:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `AppointmentDate` datetime DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `Status` enum('InReview','Approved','Completed','Cancelled') DEFAULT NULL,
  `ServiceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `DoctorID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(80) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Municipality` varchar(255) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(10) DEFAULT NULL,
  `isAdmin` int(10) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `ContactNumber`, `Specialization`, `Email`, `Password`, `Address`, `Municipality`, `City`, `ZipCode`, `isAdmin`, `DateCreated`) VALUES
(1, 'admin', 'admin', NULL, NULL, NULL, NULL, 'admin@eyecare.com', '$2y$10$BEOHhiy2Y9EeaNShnv7P8OI.arvQlyqh61/YSn1st.SLmfIUV3G0S', NULL, NULL, NULL, NULL, 1, '2024-06-02 12:07:08'),
(3, 'Juan', 'Dela Cruz', '2024-06-11', 'Male', '09063371371', NULL, 'juandelacruz@gmail.com', '$2y$10$9PQ9cwRunfQYSSLKu2FbRuI.4r/rUX/KVgo6cVXoUxDybq2jPhW6u', 'blk 43d lot 17 heritage homes, loma de gato', '123123', 'bulacan', '3019', 0, '2024-06-02 12:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecords`
--

CREATE TABLE `medicalrecords` (
  `RecordID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `AppointmentID` int(11) DEFAULT NULL,
  `RecordDate` datetime DEFAULT NULL,
  `Diagnosis` text DEFAULT NULL,
  `Treatment` text DEFAULT NULL,
  `Prescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`, `updated_at`) VALUES
(7, 63, 'Appointment Approved!', 'Your appointment on July 3, 2024 at 12:30 PM has been approved by Dr. Juan Dela Cruz.', 'Appointment', 0, '2024-07-03 09:41:32', '2024-07-03 09:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires`) VALUES
(1, 'jeaysdigo@gmail.com', '635e359bc6e2d0c0b719fdba2e8f3768e0da14ef27d08bf2a7a8ab54dec697bc6f0ad4b9cc1b48325debb3f511f757359386', 1718445166),
(2, 'sample@gmail.com', '12ff2fb7cfd4457c206c02d5af5dcca44d38741b1df08cedfaa2aae8002a6c8ee4313efa5d61292841377100b316904f4801', 1718445183),
(3, 'jeaysdigo@gmail.com', '4c07acdf2be2ffd5bcbb2fb8daf759d518037e5803e2fb5036c3c8e2c7740229ae4cf284255827c6cc49156216e794a29180', 1718445309),
(4, 'jeaysdigo@outlook.com', 'ac7a7cf0e845e73e1cc4c3f9253e1561b4d637ddd5a1732d565b6cc1027b2d6987ee91f78e43af28b4037132e3643c211cec', 1718445978),
(7, 'juandelacruz@gmail.com', 'ae462b52a5ecd86cf2f95054ed1833e7fc2d7dd7141de013cb8fbe99f12443a07148f427ba60586cc6e24b9be0989864dc3e', 1719145109),
(8, 'juandelacruz@gmail.com', '06f922602595d0b0d62b102e049426a83bf2724316b44bbdead32b4ecf5aa27854f3f18046bff20518161bfb4128b6535b3f', 1719145110),
(9, 'juandelacruz@gmail.com', 'f3bfb85556f713351eb5d4bdfd51a706ee88943e3721f6051ab7dd4e5fc84a052bed844a421cacbbf09ddf425cd86c0acd42', 1719145236),
(10, 'juandelacruz@gmail.com', '80378860ef6c5b244ebd8c6d3f0cc9036a43991f71d03cfcbfe7e2f016a1bff461ed563004f8cdda7e029a41d28b1dfaae97', 1719848553),
(11, 'jeaysdigo@gmail.com', '4eb711e71abc95fb7b1e405873d92d4bcd665ffab3e5146a6a44d3d1bfb1911fbe1ab206d9574655d95c491b0b004020375d', 1719851545),
(12, 'jeaysdigo@gmail.com', '05398b8500dba374b2c6cb80b03b0944052011ff9bc51c01b5327e962aa7505837921a55c6e619c105d2972827da04becb70', 1719851582),
(13, 'jeaysdigo@gmail.com', '7e3089f9fc1cc5649f6dd0f6075fa9605d8deec139a33097fc6d0a7a96e064557eb7b19b992074a9c5e09b83b24a699143e6', 1719851673),
(14, 'jeaysdigo@gmail.com', '300f1e160ca67e326f6a36c76d4916a74b70da37099404a9dcbc00dc54e28a3316d2988bef7a8cd18d48647d265ada2fdaf7', 1719851708),
(15, 'jeaysdigo@gmail.com', 'd8a7bd333d32872a2435d55066ee6a2a47ba473a61207e4194c7152b4d6c17c4fdff3bb4c1eff6bcb77f51afc6dacd261da4', 1719851719),
(16, 'jeaysdigo@gmail.com', '2dcfba10a2efae3fd4c9b9ed6f97ba2a84a1b24e34d68a54e1c2f40192974f50f45c9c3c48ceaa454a483297295fdaa278b1', 1719851742),
(17, 'jeaysdigo@gmail.com', 'ba58f0268ebe4d546042caf90f781220c9ec6eb870aeffb316459d772b3ac3040eacc7d8974668fd01262f1287a9d537c898', 1719851763),
(18, 'jeaysdigo@gmail.com', '4372c0e4fa3f3b6934d336ca97063b6e95b45d863f7615b4c5814d3bc37c470e2a313a10ff0f55f48d46793ea52e5df9744c', 1719851791),
(19, 'jeaysdigo@gmail.com', 'e9036093bc397597a0cafd4286b2cad4713a60933b8241012682e64b8a713db84017ef2832349760a49ae1e529099b2cf360', 1719851855),
(20, 'jeaysdigo@gmail.com', '07e59afc5cda69cc396b05c832270e075e686897ff8c14b53d8ad4212c9db88bf2e28dd44ccba37e974f078ca7496f9503b6', 1719851862),
(21, 'jeaysdigo@gmail.com', '931969c0a0b7af61f3b5343e00a360fd2b378a7fdb57973f210cde7df3a6d64b394f8029e4275a94c0ab27194c6f81e9533f', 1719851898),
(22, 'jeaysdigo@gmail.com', '94f1d06df957cfe855af44375abdc452642edd388e9044f88be93ad1940d68ba34e55019d867a68e9aca550c1ac0c764e8c4', 1719851915),
(23, 'jeaysdigo@gmail.com', '114e57c0a57bb381dc8d583445432e78284d5c515d477502ea31bfc6f0dbe80a32c76a43bd10871cefc8876eff68edcbbd40', 1719851973),
(24, 'jeaysdigo@outlook.com', 'be4fee3565c470cb0fd8962377f8f936d853bdc1114f5e9dbd7f518d2556b50affbe80802f894baab519fa58b601e40cedd6', 1719852033),
(25, 'jeaysdigo@outlook.com', 'ff7eafb8191a0864fe09e8ab8ee9b3c725ce076edebe0d27ef37d725e6e156c45a39b08f52cd498ce808258daca7ea7c3422', 1719852051),
(26, 'jeaysdigo@outlook.com', 'bc8069fa4471370a5fa91fac180ba2802ebc091528aac15362e57b6e09d1ff0ac035a403c867c50fb1ba2d6c35d7fe286144', 1719852085),
(27, 'jeaysdigo@outlook.com', '3bb5e7fee60718d022038073de9c7fb84dc81e69e9cb813cd813cf073ec5b3189712a6a6f5b2d81e8681644cbea436a6db4e', 1719852249),
(28, 'jeaysdigo@outlook.com', 'dbf3e0ee8c2d87d6ff1baaf93ce64a732ca6298c250f50617cb6522b70e1b2cb439758bf5930c7edd0c4cb0be0e7b02d3a8b', 1719852366),
(29, 'jeaysdigo@outlook.com', 'cf3e533b30c3ea43753f186363fee66804ff89a81d5d124c92abc54f3cf20c48451b59fddc40207477e401e122d9aaa481da', 1719852367),
(30, 'jeaysdigo@outlook.com', '616ec215866fda2f0075babebeda33e0f8a273e3f8c5f524d26508b0dfcf5bfddf87bc304f37169097800f2d2d98f5314811', 1719852390),
(31, 'jeaysdigo@outlook.com', 'bce05ebf4fcd4b9b224d6b14255d73ca72229c11b558e8dc555a650ffff678a21f63e3e944cb5b4fff31c0d8a9d3bb031691', 1719852402),
(32, 'jeaysdigo@outlook.com', 'f263ee069b88178a76b0a71e9ad1f77d1ec85746ceef377b5b1e9b9431fe2d87c19a0115c75775dedc4882a74921582b813c', 1719900409),
(33, 'admin@eyecare.com', '241faaefbc2812f97b36ae08cd4f1b7ac3caedcc1d49813a48828349ed9a036372a6e5ed6d8c1462951869777fea45b2eb71', 1720001816);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Occupation` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(80) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Municipality` varchar(255) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(10) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientID`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `ContactNumber`, `Occupation`, `Email`, `Password`, `Address`, `Municipality`, `City`, `ZipCode`, `DateCreated`) VALUES
(63, 'Patient1', 'Patient1', '2024-07-03', 'Male', '09166750154', 'none', 'patient@gmail.com', '$2y$10$rRRyE9AFMoJNcoPkQOrxbeHU9ay3XSKcvoDGWvvN1eDlgrGjBg9iO', 'Heritage homes', 'marilao', 'bulacan', '3019', '2024-07-03 09:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Cost` decimal(10,2) DEFAULT NULL,
  `Icon` blob DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `testID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `walkin` tinyint(1) NOT NULL,
  `isSubmitted` tinyint(4) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` timestamp NULL DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Occupation` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Municipality` varchar(255) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(10) DEFAULT NULL,
  `case_no` varchar(50) DEFAULT NULL,
  `co_no` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `bp_sys` varchar(50) DEFAULT NULL,
  `bp_dia` varchar(50) DEFAULT NULL,
  `resp_rate` varchar(50) DEFAULT NULL,
  `pulse_rate` varchar(50) DEFAULT NULL,
  `glasses_od_sph` varchar(50) DEFAULT NULL,
  `glasses_od_cyl` varchar(50) DEFAULT NULL,
  `glasses_od_add` varchar(50) DEFAULT NULL,
  `glasses_os_sph` varchar(50) DEFAULT NULL,
  `glasses_os_cyl` varchar(50) DEFAULT NULL,
  `glasses_os_add` varchar(50) DEFAULT NULL,
  `contact_lens_od` varchar(50) DEFAULT NULL,
  `contact_lens_os` varchar(50) DEFAULT NULL,
  `type_scl` tinyint(1) DEFAULT NULL,
  `type_gp` tinyint(1) DEFAULT NULL,
  `type_toric` tinyint(1) DEFAULT NULL,
  `visual_ocular` text DEFAULT NULL,
  `medical_history_present` text DEFAULT NULL,
  `medical_history_past` text DEFAULT NULL,
  `family_history` text DEFAULT NULL,
  `family_history_ocular` text DEFAULT NULL,
  `family_history_medical` text DEFAULT NULL,
  `visual_acuity_unaided_distance_od` text DEFAULT NULL,
  `visual_acuity_unaided_distance_os` text DEFAULT NULL,
  `visual_acuity_unaided_distance_ou` text DEFAULT NULL,
  `visual_acuity_unaided_near_od` text DEFAULT NULL,
  `visual_acuity_unaided_near_os` text DEFAULT NULL,
  `visual_acuity_unaided_near_ou` text DEFAULT NULL,
  `visual_acuity_pinhole_od` text DEFAULT NULL,
  `visual_acuity_pinhole_os` text DEFAULT NULL,
  `visual_acuity_far_od` text DEFAULT NULL,
  `visual_acuity_far_os` text DEFAULT NULL,
  `visual_acuity_far_ou` text DEFAULT NULL,
  `visual_acuity_near_od` text DEFAULT NULL,
  `visual_acuity_near_os` text DEFAULT NULL,
  `visual_acuity_near_ou` text DEFAULT NULL,
  `pupil_shape_od` text DEFAULT NULL,
  `pupil_shape_os` text DEFAULT NULL,
  `pupil_diameter_od` text DEFAULT NULL,
  `pupil_diameter_os` text DEFAULT NULL,
  `pd` varchar(50) DEFAULT NULL,
  `de` varchar(50) DEFAULT NULL,
  `eyes_not_aligned` tinyint(4) DEFAULT NULL,
  `abnormal_head_posture` tinyint(4) DEFAULT NULL,
  `face_tilt_direction` tinyint(4) DEFAULT NULL,
  `head_tilt_direction` tinyint(4) DEFAULT NULL,
  `other_pertinent_observations` text DEFAULT NULL,
  `motor_sensory_push_up_amp` text DEFAULT NULL,
  `motor_sensory_npc` text DEFAULT NULL,
  `motor_sensory_corneal_reflex_od` text DEFAULT NULL,
  `motor_sensory_corneal_reflex_os` text DEFAULT NULL,
  `motor_sensory_alternate_cover_test_far_sc` text DEFAULT NULL,
  `motor_sensory_alternate_cover_test_far_cc` text DEFAULT NULL,
  `motor_sensory_alternate_cover_test_near_sc` text DEFAULT NULL,
  `motor_sensory_alternate_cover_test_near_cc` text DEFAULT NULL,
  `motor_sensory_motility_test_smooth_pursuit` text DEFAULT NULL,
  `motor_sensory_motility_test_saccadic` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_dlr_od` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_dlr_os` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_indirect_od` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_indirect_os` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_accommodation_od` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_accommodation_os` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_swinging_flashlight_od` text DEFAULT NULL,
  `motor_sensory_pupillary_reflex_swinging_flashlight_os` text DEFAULT NULL,
  `motor_sensory_amsler_test_od` text DEFAULT NULL,
  `motor_sensory_amsler_test_os` text DEFAULT NULL,
  `motor_sensory_proj_test_od` text DEFAULT NULL,
  `motor_sensory_proj_test_os` text DEFAULT NULL,
  `objective_refraction_static_retinoscopy_od` text DEFAULT NULL,
  `objective_refraction_static_retinoscopy_od_over` text DEFAULT NULL,
  `objective_refraction_static_retinoscopy_os` text DEFAULT NULL,
  `objective_refraction_static_retinoscopy_os_over` text DEFAULT NULL,
  `objective_refraction_dynamic_retinoscopy_od` text DEFAULT NULL,
  `objective_refraction_dynamic_retinoscopy_os` text DEFAULT NULL,
  `subjective_refraction_manifest_mono_od` text DEFAULT NULL,
  `subjective_refraction_manifest_mono_os` text DEFAULT NULL,
  `subjective_refraction_manifest_bino_od` text DEFAULT NULL,
  `subjective_refraction_manifest_bino_os` text DEFAULT NULL,
  `subjective_refraction_visual_acuity_od` text DEFAULT NULL,
  `subjective_refraction_visual_acuity_os` text DEFAULT NULL,
  `subjective_refraction_visual_acuity_ou` text DEFAULT NULL,
  `subjective_refraction_cycloplegic_od` text DEFAULT NULL,
  `subjective_refraction_cycloplegic_os` text DEFAULT NULL,
  `subjective_refraction_cycloplegic_visual_acuity_od` text DEFAULT NULL,
  `subjective_refraction_cycloplegic_visual_acuity_os` text DEFAULT NULL,
  `phorometric_test_lateral_phoria_20ft_habitual` text DEFAULT NULL,
  `phorometric_test_lateral_phoria_20ft_induced` text DEFAULT NULL,
  `phorometric_test_lateral_phoria_16in_habitual` text DEFAULT NULL,
  `phorometric_test_lateral_phoria_16in_induced` text DEFAULT NULL,
  `phorometric_test_lateral_phoria_16in_induced_13bg` text DEFAULT NULL,
  `phorometric_test_vertical_phoria_20ft` text DEFAULT NULL,
  `phorometric_test_vertical_phoria_16in` text DEFAULT NULL,
  `phorometric_test_duction_20ft` text DEFAULT NULL,
  `phorometric_test_duction_16in` text DEFAULT NULL,
  `vergence_test_bi_20ft` text DEFAULT NULL,
  `vergence_test_bo_20ft` text DEFAULT NULL,
  `vergence_test_bi_16in` text DEFAULT NULL,
  `vergence_test_bo_16in` text DEFAULT NULL,
  `accommodation_test_amp_of_accom` text DEFAULT NULL,
  `accommodation_test_unfussed_crossed_cyl_od` text DEFAULT NULL,
  `accommodation_test_unfussed_crossed_cyl_os` text DEFAULT NULL,
  `accommodation_test_unfussed_crossed_cyl_other` text DEFAULT NULL,
  `accommodation_test_fused_crossed_cyl_od` text DEFAULT NULL,
  `accommodation_test_fused_crossed_cyl_os` text DEFAULT NULL,
  `accommodation_test_fused_crossed_cyl_other` text DEFAULT NULL,
  `accommodation_test_nra_od` text DEFAULT NULL,
  `accommodation_test_nra_os` text DEFAULT NULL,
  `accommodation_test_pra_od` text DEFAULT NULL,
  `accommodation_test_pra_os` text DEFAULT NULL,
  `prism_cover_test_hirschberg` text DEFAULT NULL,
  `hirshberg_test` text DEFAULT NULL,
  `worths_four_dots_far` text DEFAULT NULL,
  `worths_four_dots_near` text DEFAULT NULL,
  `krimsky_test` text DEFAULT NULL,
  `maddox_rod` text DEFAULT NULL,
  `color_vision_ishihara_test` text DEFAULT NULL,
  `color_vision_d15_test` text DEFAULT NULL,
  `visual_field_test_confrontation_od` text DEFAULT NULL,
  `visual_field_test_confrontation_os` text DEFAULT NULL,
  `visual_field_test_ats_od` text DEFAULT NULL,
  `visual_field_test_ats_os` text DEFAULT NULL,
  `trial_framing_distance_od` text DEFAULT NULL,
  `trial_framing_distance_os` text DEFAULT NULL,
  `trial_framing_distance_od_over` text DEFAULT NULL,
  `trial_framing_distance_os_over` text DEFAULT NULL,
  `trial_framing_add_od` text DEFAULT NULL,
  `trial_framing_add_os` text DEFAULT NULL,
  `trial_framing_add_od_over` text DEFAULT NULL,
  `trial_framing_add_os_over` text DEFAULT NULL,
  `biomicroscopy_eyelids_od` text DEFAULT NULL,
  `biomicroscopy_eyelids_os` text DEFAULT NULL,
  `biomicroscopy_eyelashes_od` text DEFAULT NULL,
  `biomicroscopy_eyelashes_os` text DEFAULT NULL,
  `biomicroscopy_lid_margin_od` text DEFAULT NULL,
  `biomicroscopy_lid_margin_os` text DEFAULT NULL,
  `biomicroscopy_ducts_od` text DEFAULT NULL,
  `biomicroscopy_ducts_os` text DEFAULT NULL,
  `biomicroscopy_conjunctiva_od` text DEFAULT NULL,
  `biomicroscopy_conjunctiva_os` text DEFAULT NULL,
  `biomicroscopy_sclera_od` text DEFAULT NULL,
  `biomicroscopy_sclera_os` text DEFAULT NULL,
  `biomicroscopy_pupil_od` text DEFAULT NULL,
  `biomicroscopy_pupil_os` text DEFAULT NULL,
  `biomicroscopy_iris_od` text DEFAULT NULL,
  `biomicroscopy_iris_os` text DEFAULT NULL,
  `biomicroscopy_lens_od` text DEFAULT NULL,
  `biomicroscopy_lens_os` text DEFAULT NULL,
  `biomicroscopy_other_tests` text DEFAULT NULL,
  `biomicroscopy_von_herrick` text DEFAULT NULL,
  `biomicroscopy_tbut` text DEFAULT NULL,
  `biomicroscopy_schirmers_test` text DEFAULT NULL,
  `biomicroscopy_tear_meniscus` text DEFAULT NULL,
  `biomicroscopy_image` mediumblob DEFAULT NULL,
  `intra_ocular_pressure_tactile_od` text DEFAULT NULL,
  `intra_ocular_pressure_tactile_os` text DEFAULT NULL,
  `intra_ocular_pressure_tactile_time_taken` text DEFAULT NULL,
  `intra_ocular_pressure_tactile_time_tested` text DEFAULT NULL,
  `intra_ocular_pressure_tonometry_applanation_od` text DEFAULT NULL,
  `intra_ocular_pressure_tonometry_applanation_os` text DEFAULT NULL,
  `intra_ocular_pressure_tonometry_applanation_time_taken` text DEFAULT NULL,
  `intra_ocular_pressure_tonometry_applanation_time_tested` text DEFAULT NULL,
  `intra_ocular_pressure_icare_od` text DEFAULT NULL,
  `intra_ocular_pressure_icare_os` text DEFAULT NULL,
  `intra_ocular_pressure_icare_time_taken` text DEFAULT NULL,
  `intra_ocular_pressure_icare_os_time_tested` text DEFAULT NULL,
  `posterior_segment_exam_ror_od` text DEFAULT NULL,
  `posterior_segment_exam_ror_os` text DEFAULT NULL,
  `posterior_segment_exam_media_od` text DEFAULT NULL,
  `posterior_segment_exam_media_os` text DEFAULT NULL,
  `posterior_segment_exam_optic_disc_od` text DEFAULT NULL,
  `posterior_segment_exam_optic_disc_os` text DEFAULT NULL,
  `posterior_segment_exam_cd_od` text DEFAULT NULL,
  `posterior_segment_exam_cd_os` text DEFAULT NULL,
  `posterior_segment_exam_av_od` text DEFAULT NULL,
  `posterior_segment_exam_av_os` text DEFAULT NULL,
  `posterior_segment_exam_edema_od` text DEFAULT NULL,
  `posterior_segment_exam_edema_os` text DEFAULT NULL,
  `posterior_segment_exam_hemorrhage_od` text DEFAULT NULL,
  `posterior_segment_exam_hemorrhage_os` text DEFAULT NULL,
  `posterior_segment_exam_exudates_od` text DEFAULT NULL,
  `posterior_segment_exam_exudates_os` text DEFAULT NULL,
  `posterior_segment_exam_cotton_wool_spots_od` text DEFAULT NULL,
  `posterior_segment_exam_cotton_wool_spots_os` text DEFAULT NULL,
  `posterior_segment_exam_foveal_reflex_od` text DEFAULT NULL,
  `posterior_segment_exam_foveal_reflex_os` text DEFAULT NULL,
  `posterior_segment_exam` mediumblob DEFAULT NULL,
  `evaluation_impression` text DEFAULT NULL,
  `evaluation_finalrx` text DEFAULT NULL,
  `evaluation_referral` text DEFAULT NULL,
  `evaluation_follow_up` text DEFAULT NULL,
  `evaluation_external` text DEFAULT NULL,
  `evaluation_refraction_obj` text DEFAULT NULL,
  `evaluation_refraction_subj` text DEFAULT NULL,
  `evaluation_other_test` text DEFAULT NULL,
  `evaluation_ass_management` text DEFAULT NULL,
  `evaluation_dispensing` text DEFAULT NULL,
  `evaluation_supervisor` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD UNIQUE KEY `ContactNumber` (`ContactNumber`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  ADD PRIMARY KEY (`RecordID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `AppointmentID` (`AppointmentID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientID`),
  ADD UNIQUE KEY `ContactNumber` (`ContactNumber`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`testID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  MODIFY `RecordID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `testID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatientID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`);

--
-- Constraints for table `medicalrecords`
--
ALTER TABLE `medicalrecords`
  ADD CONSTRAINT `medicalrecords_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatientID`),
  ADD CONSTRAINT `medicalrecords_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`),
  ADD CONSTRAINT `medicalrecords_ibfk_3` FOREIGN KEY (`AppointmentID`) REFERENCES `appointments` (`AppointmentID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `patients` (`PatientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
