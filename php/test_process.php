<?php
require_once 'connect.php';
// Start the session
session_start();

// Function to sanitize inputs
function sanitizeInput($input) {
    global $conn; // Assuming $conn is your database connection

    // Use mysqli_real_escape_string to escape inputs
    return mysqli_real_escape_string($conn, trim($input));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $patientId = sanitizeInput($_POST['PatientID']);
    $doctorId = sanitizeInput($_POST['DoctorID']);
    $walkIn = sanitizeInput($_POST['walkIn']);
    $firstName = sanitizeInput($_POST['FirstName']);
    $lastName = sanitizeInput($_POST['LastName']);
    $dateOfBirth = sanitizeInput($_POST['DateOfBirth']);
    $gender = sanitizeInput($_POST['Gender']);
    $contactNumber = sanitizeInput($_POST['ContactNumber']);
    $occupation = sanitizeInput($_POST['Occupation']);
    $email = sanitizeInput($_POST['Email']);
    $address = sanitizeInput($_POST['Address']);
    $municipality = sanitizeInput($_POST['Municipality']);
    $city = sanitizeInput($_POST['City']);
    $zipCode = sanitizeInput($_POST['ZipCode']);
    $caseNo = sanitizeInput($_POST['case_no']);
    $coNo = sanitizeInput($_POST['co_no']);
    $bpSys = sanitizeInput($_POST['bp_sys']);
    $bpDia = sanitizeInput($_POST['bp_dia']);
    $respRate = sanitizeInput($_POST['resp_rate']);
    $pulseRate = sanitizeInput($_POST['pulse_rate']);
    $glassesOdSph = sanitizeInput($_POST['glasses_od_sph']);
    $glassesOdCyl = sanitizeInput($_POST['glasses_od_cyl']);
    $glassesOdAdd = sanitizeInput($_POST['glasses_od_add']);
    $glassesOsSph = sanitizeInput($_POST['glasses_os_sph']);
    $glassesOsCyl = sanitizeInput($_POST['glasses_os_cyl']);
    $glassesOsAdd = sanitizeInput($_POST['glasses_os_add']);
    $contactLensOd = sanitizeInput($_POST['contact_lens_od']);
    $contactLensOs = sanitizeInput($_POST['contact_lens_os']);
    $typeScl = isset($_POST['type_scl']) ? 1 : 0;
    $typeGp = isset($_POST['type_gp']) ? 1 : 0;
    $typeToric = isset($_POST['type_toric']) ? 1 : 0;

    // step 2
    $visualOcular = sanitizeInput($_POST['visual_ocular']);
    $medicalHistoryPresent = sanitizeInput($_POST['medical_history_present']);
    $medicalHistoryPast = sanitizeInput($_POST['medical_history_past']);
    $familyHistory = sanitizeInput($_POST['family_history']);
    $familyHistoryOcular = sanitizeInput($_POST['family_history_ocular']);
    $familyHistoryMedical = sanitizeInput($_POST['family_history_medical']);

    // step 3
    $visualAcuityUnaidedDistanceOd = sanitizeInput($_POST['visual_acuity_unaided_distance_od']);
    $visualAcuityUnaidedDistanceOs = sanitizeInput($_POST['visual_acuity_unaided_distance_os']);
    $visualAcuityUnaidedDistanceOu = sanitizeInput($_POST['visual_acuity_unaided_distance_ou']);
    $visualAcuityUnaidedNearOd = sanitizeInput($_POST['visual_acuity_unaided_near_od']);
    $visualAcuityUnaidedNearOs = sanitizeInput($_POST['visual_acuity_unaided_near_os']);
    $visualAcuityUnaidedNearOu = sanitizeInput($_POST['visual_acuity_unaided_near_ou']);
    $visualAcuityPinholeOd = sanitizeInput($_POST['visual_acuity_pinhole_od']);
    $visualAcuityPinholeOs = sanitizeInput($_POST['visual_acuity_pinhole_os']);
    $visualAcuityFarOd = sanitizeInput($_POST['visual_acuity_far_od']);
    $visualAcuityFarOs = sanitizeInput($_POST['visual_acuity_far_os']);
    $visualAcuityFarOu = sanitizeInput($_POST['visual_acuity_far_ou']);
    $visualAcuityNearOd = sanitizeInput($_POST['visual_acuity_near_od']);
    $visualAcuityNearOs = sanitizeInput($_POST['visual_acuity_near_os']);
    $visualAcuityNearOu = sanitizeInput($_POST['visual_acuity_near_ou']);
    $pupilShapeOd = sanitizeInput($_POST['pupil_shape_od']);
    $pupilShapeOs = sanitizeInput($_POST['pupil_shape_os']);
    $pupilDiameterOd = sanitizeInput($_POST['pupil_diameter_od']);
    $pupilDiameterOs = sanitizeInput($_POST['pupil_diameter_os']);
    $pd = sanitizeInput($_POST['pd']);
    $de = sanitizeInput($_POST['de']);
    $eyesNotAligned = isset($_POST['eyes_not_aligned']) ? 1 : 0;
    $abnormalHeadPosture = isset($_POST['abnormal_head_posture']) ? 1 : 0;
    $faceTiltDirection = isset($_POST['face_tilt_direction']) ? 1 : 0;
    $headTiltDirection = isset($_POST['head_tilt_direction']) ? 1 : 0;
    $otherPertinentObservations = sanitizeInput($_POST['other_pertinent_observations']);
    $motorSensoryPushUpAmp = sanitizeInput($_POST['motor_sensory_push_up_amp']);
    $motorSensoryNpc = sanitizeInput($_POST['motor_sensory_npc']);
    $motorSensoryCornealReflexOd = sanitizeInput($_POST['motor_sensory_corneal_reflex_od']);
    $motorSensoryCornealReflexOs = sanitizeInput($_POST['motor_sensory_corneal_reflex_os']);
    $motorSensoryAlternateCoverTestFarSc = sanitizeInput($_POST['motor_sensory_alternate_cover_test_far_sc']);
    $motorSensoryAlternateCoverTestFarCc = sanitizeInput($_POST['motor_sensory_alternate_cover_test_far_cc']);
    $motorSensoryAlternateCoverTestNearSc = sanitizeInput($_POST['motor_sensory_alternate_cover_test_near_sc']);
    $motorSensoryAlternateCoverTestNearCc = sanitizeInput($_POST['motor_sensory_alternate_cover_test_near_cc']);
    $motorSensoryMotilityTestSmoothPursuit = sanitizeInput($_POST['motor_sensory_motility_test_smooth_pursuit']);
    $motorSensoryMotilityTestSaccadic = sanitizeInput($_POST['motor_sensory_motility_test_saccadic']);
    $motorSensoryPupillaryReflexDlrOd = sanitizeInput($_POST['motor_sensory_pupillary_reflex_dlr_od']);
    $motorSensoryPupillaryReflexDlrOs = sanitizeInput($_POST['motor_sensory_pupillary_reflex_dlr_os']);
    $motorSensoryPupillaryReflexIndirectOd = sanitizeInput($_POST['motor_sensory_pupillary_reflex_indirect_od']);
    $motorSensoryPupillaryReflexIndirectOs = sanitizeInput($_POST['motor_sensory_pupillary_reflex_indirect_os']);
    $motorSensoryPupillaryReflexAccommodationOd = sanitizeInput($_POST['motor_sensory_pupillary_reflex_accommodation_od']);
    $motorSensoryPupillaryReflexAccommodationOs = sanitizeInput($_POST['motor_sensory_pupillary_reflex_accommodation_os']);
    $motorSensoryPupillaryReflexSwingingFlashlightOd = sanitizeInput($_POST['motor_sensory_pupillary_reflex_swinging_flashlight_od']);
    $motorSensoryPupillaryReflexSwingingFlashlightOs = sanitizeInput($_POST['motor_sensory_pupillary_reflex_swinging_flashlight_os']);
    $motorSensoryAmslerTestOd = sanitizeInput($_POST['motor_sensory_amsler_test_od']);
    $motorSensoryAmslerTestOs = sanitizeInput($_POST['motor_sensory_amsler_test_os']);
    $motorSensoryProjTestOd = sanitizeInput($_POST['motor_sensory_proj_test_od']);
    $motorSensoryProjTestOs = sanitizeInput($_POST['motor_sensory_proj_test_os']);

    // step 4
    $objective_refraction_static_retinoscopy_od = sanitizeInput($_POST['objective_refraction_static_retinoscopy_od']);
    $objective_refraction_static_retinoscopy_os = sanitizeInput($_POST['objective_refraction_static_retinoscopy_os']);
    $objective_refraction_dynamic_retinoscopy_od = sanitizeInput($_POST['objective_refraction_dynamic_retinoscopy_od']);
    $objective_refraction_dynamic_retinoscopy_os = sanitizeInput($_POST['objective_refraction_dynamic_retinoscopy_os']);

    // step 5
    $subjective_refraction_manifest_mono_od = sanitizeInput($_POST['subjective_refraction_manifest_mono_od']);
    $subjective_refraction_manifest_mono_os = sanitizeInput($_POST['subjective_refraction_manifest_mono_os']);
    $subjective_refraction_manifest_bino_od = sanitizeInput($_POST['subjective_refraction_manifest_bino_od']);
    $subjective_refraction_manifest_bino_os = sanitizeInput($_POST['subjective_refraction_manifest_bino_os']);
    $subjective_refraction_visual_acuity_od = sanitizeInput($_POST['subjective_refraction_visual_acuity_od']);
    $subjective_refraction_visual_acuity_os = sanitizeInput($_POST['subjective_refraction_visual_acuity_os']);
    $subjective_refraction_visual_acuity_ou = sanitizeInput($_POST['subjective_refraction_visual_acuity_ou']);
    $subjective_refraction_cycloplegic_od = sanitizeInput($_POST['subjective_refraction_cycloplegic_od']);
    $subjective_refraction_cycloplegic_os = sanitizeInput($_POST['subjective_refraction_cycloplegic_os']);
    $subjective_refraction_cycloplegic_visual_acuity_od = sanitizeInput($_POST['subjective_refraction_cycloplegic_visual_acuity_od']);
    $subjective_refraction_cycloplegic_visual_acuity_os = sanitizeInput($_POST['subjective_refraction_cycloplegic_visual_acuity_os']);

    //step 6
    $phorometricTestLateralPhoria20ftHabitual = sanitizeInput($_POST['phorometric_test_lateral_phoria_20ft_habitual']);
    $phorometricTestLateralPhoria20ftInduced = sanitizeInput($_POST['phorometric_test_lateral_phoria_20ft_induced']);
    $phorometricTestLateralPhoria16inHabitual = sanitizeInput($_POST['phorometric_test_lateral_phoria_16in_habitual']);
    $phorometricTestLateralPhoria16inInduced = sanitizeInput($_POST['phorometric_test_lateral_phoria_16in_induced']);
    $phorometricTestLateralPhoria16inInduced13BG = sanitizeInput($_POST['phorometric_test_lateral_phoria_16in_induced_13bg']);
    $phorometricTestVerticalPhoria20ft = sanitizeInput($_POST['phorometric_test_vertical_phoria_20ft']);
    $phorometricTestVerticalPhoria16in = sanitizeInput($_POST['phorometric_test_vertical_phoria_16in']);
    $phorometricTestDuction20ft = sanitizeInput($_POST['phorometric_test_duction_20ft']);
    $phorometricTestDuction16in = sanitizeInput($_POST['phorometric_test_duction_16in']);
    $vergenceTestBi20ft = sanitizeInput($_POST['vergence_test_bi_20ft']);
    $vergenceTestBo20ft = sanitizeInput($_POST['vergence_test_bo_20ft']);
    $vergenceTestBi16in = sanitizeInput($_POST['vergence_test_bi_16in']);
    $vergenceTestBo16in = sanitizeInput($_POST['vergence_test_bo_16in']);
    $accommodationTestAmpOfAccom = sanitizeInput($_POST['accommodation_test_amp_of_accom']);
    $accommodationTestUnfussedCrossedCylOD = sanitizeInput($_POST['accommodation_test_unfussed_crossed_cyl_od']);
    $accommodationTestUnfussedCrossedCylOS = sanitizeInput($_POST['accommodation_test_unfussed_crossed_cyl_os']);
    $accommodationTestUnfussedCrossedCylOther = sanitizeInput($_POST['accommodation_test_unfussed_crossed_cyl_other']);
    $accommodationTestFusedCrossedCylOD = sanitizeInput($_POST['accommodation_test_fused_crossed_cyl_od']);
    $accommodationTestFusedCrossedCylOS = sanitizeInput($_POST['accommodation_test_fused_crossed_cyl_os']);
    $accommodationTestFusedCrossedCylOther = sanitizeInput($_POST['accommodation_test_fused_crossed_cyl_other']);
    $accommodationTestNraOD = sanitizeInput($_POST['accommodation_test_nra_od']);
    $accommodationTestNraOS = sanitizeInput($_POST['accommodation_test_nra_os']);
    $accommodationTestPraOD = sanitizeInput($_POST['accommodation_test_pra_od']);
    $accommodationTestPraOS = sanitizeInput($_POST['accommodation_test_pra_os']);

    //step 7
    $prism_cover_test_hirschberg = sanitizeInput($_POST['prism_cover_test_hirschberg']);
    $hirshberg_test = sanitizeInput($_POST['hirshberg_test']);
    $worths_four_dots_far = sanitizeInput($_POST['worths_four_dots_far']);
    $worths_four_dots_near = sanitizeInput($_POST['worths_four_dots_near']);
    $krimsky_test = sanitizeInput($_POST['krimsky_test']);
    $maddox_rod = sanitizeInput($_POST['maddox_rod']);
    $color_vision_ishihara_test = sanitizeInput($_POST['color_vision_ishihara_test']);
    $color_vision_d15_test = sanitizeInput($_POST['color_vision_d15_test']);
    $visual_field_test_confrontation_od = sanitizeInput($_POST['visual_field_test_confrontation_od']);
    $visual_field_test_confrontation_os = sanitizeInput($_POST['visual_field_test_confrontation_os']);
    $visual_field_test_ats_od = sanitizeInput($_POST['visual_field_test_ats_od']);
    $visual_field_test_ats_os = sanitizeInput($_POST['visual_field_test_ats_os']);

    //step 8 
    $trial_framing_distance_od = $_POST['trial_framing_distance_od'];
    $trial_framing_distance_os = $_POST['trial_framing_distance_os'];
    $trial_framing_distance_od_over = $_POST['trial_framing_distance_od_over'];
    $trial_framing_distance_os_over = $_POST['trial_framing_distance_os_over'];
    $trial_framing_add_od = $_POST['trial_framing_add_od'];
    $trial_framing_add_os = $_POST['trial_framing_add_os'];
    $trial_framing_add_od_over = $_POST['trial_framing_add_od_over'];
    $trial_framing_add_os_over = $_POST['trial_framing_add_os_over'];

     // Step 9 Fields
     $biomicroscopy_eyelids_od = $_POST['biomicroscopy_eyelids_od'];
     $biomicroscopy_eyelids_os = $_POST['biomicroscopy_eyelids_os'];
     $biomicroscopy_eyelashes_od = $_POST['biomicroscopy_eyelashes_od'];
     $biomicroscopy_eyelashes_os = $_POST['biomicroscopy_eyelashes_os'];
     $biomicroscopy_lid_margin_od = $_POST['biomicroscopy_lid_margin_od'];
     $biomicroscopy_lid_margin_os = $_POST['biomicroscopy_lid_margin_os'];
     $biomicroscopy_ducts_od = $_POST['biomicroscopy_ducts_od'];
     $biomicroscopy_ducts_os = $_POST['biomicroscopy_ducts_os'];
     $biomicroscopy_conjunctiva_od = $_POST['biomicroscopy_conjunctiva_od'];
     $biomicroscopy_conjunctiva_os = $_POST['biomicroscopy_conjunctiva_os'];
     $biomicroscopy_sclera_od = $_POST['biomicroscopy_sclera_od'];
     $biomicroscopy_sclera_os = $_POST['biomicroscopy_sclera_os'];
     $biomicroscopy_pupil_od = $_POST['biomicroscopy_pupil_od'];
     $biomicroscopy_pupil_os = $_POST['biomicroscopy_pupil_os'];
     $biomicroscopy_iris_od = $_POST['biomicroscopy_iris_od'];
     $biomicroscopy_iris_os = $_POST['biomicroscopy_iris_os'];
     $biomicroscopy_lens_od = $_POST['biomicroscopy_lens_od'];
     $biomicroscopy_lens_os = $_POST['biomicroscopy_lens_os'];
     $biomicroscopy_other_tests = $_POST['biomicroscopy_other_tests'];
     $biomicroscopy_von_herrick = $_POST['biomicroscopy_von_herrick'];
     $biomicroscopy_tbut = $_POST['biomicroscopy_tbut'];
     $biomicroscopy_schirmers_test = $_POST['biomicroscopy_schirmers_test'];
     $biomicroscopy_tear_meniscus = $_POST['biomicroscopy_tear_meniscus'];
     $biomicroscopy_image = $_POST['biomicroscopy_image'];
     
     //step 10
     // Step 10 Fields
    $intra_ocular_pressure_tactile_od = $_POST['intra_ocular_pressure_tactile_od'];
    $intra_ocular_pressure_tactile_os = $_POST['intra_ocular_pressure_tactile_os'];
    $intra_ocular_pressure_tactile_time_taken = $_POST['intra_ocular_pressure_tactile_time_taken'];
    $intra_ocular_pressure_tactile_time_tested = $_POST['intra_ocular_pressure_tactile_time_tested'];
    $intra_ocular_pressure_tonometry_applanation_od = $_POST['intra_ocular_pressure_tonometry_applanation_od'];
    $intra_ocular_pressure_tonometry_applanation_os = $_POST['intra_ocular_pressure_tonometry_applanation_os'];
    $intra_ocular_pressure_tonometry_applanation_time_taken = $_POST['intra_ocular_pressure_tonometry_applanation_time_taken'];
    $intra_ocular_pressure_tonometry_applanation_time_tested = $_POST['intra_ocular_pressure_tonometry_applanation_time_tested'];
    $intra_ocular_pressure_icare_od = $_POST['intra_ocular_pressure_icare_od'];
    $intra_ocular_pressure_icare_os = $_POST['intra_ocular_pressure_icare_os'];
    $intra_ocular_pressure_icare_time_taken = $_POST['intra_ocular_pressure_icare_time_taken'];
    $intra_ocular_pressure_icare_os_time_tested = $_POST['intra_ocular_pressure_icare_os_time_tested'];

    // Step 11
    $posterior_segment_exam_ror_od = $_POST['posterior_segment_exam_ror_od'];
    $posterior_segment_exam_ror_os = $_POST['posterior_segment_exam_ror_os'];
    $posterior_segment_exam_media_od = $_POST['posterior_segment_exam_media_od'];
    $posterior_segment_exam_media_os = $_POST['posterior_segment_exam_media_os'];
    $posterior_segment_exam_optic_disc_od = $_POST['posterior_segment_exam_optic_disc_od'];
    $posterior_segment_exam_optic_disc_os = $_POST['posterior_segment_exam_optic_disc_os'];
    $posterior_segment_exam_cd_od = $_POST['posterior_segment_exam_cd_od'];
    $posterior_segment_exam_cd_os = $_POST['posterior_segment_exam_cd_os'];
    $posterior_segment_exam_av_od = $_POST['posterior_segment_exam_av_od'];
    $posterior_segment_exam_av_os = $_POST['posterior_segment_exam_av_os'];
    $posterior_segment_exam_edema_od = $_POST['posterior_segment_exam_edema_od'];
    $posterior_segment_exam_edema_os = $_POST['posterior_segment_exam_edema_os'];
    $posterior_segment_exam_hemorrhage_od = $_POST['posterior_segment_exam_hemorrhage_od'];
    $posterior_segment_exam_hemorrhage_os = $_POST['posterior_segment_exam_hemorrhage_os'];
    $posterior_segment_exam_exudates_od = $_POST['posterior_segment_exam_exudates_od'];
    $posterior_segment_exam_exudates_os = $_POST['posterior_segment_exam_exudates_os'];
    $posterior_segment_exam_cotton_wool_spots_od = $_POST['posterior_segment_exam_cotton_wool_spots_od'];
    $posterior_segment_exam_cotton_wool_spots_os = $_POST['posterior_segment_exam_cotton_wool_spots_os'];
    $posterior_segment_exam_foveal_reflex_od = $_POST['posterior_segment_exam_foveal_reflex_od'];
    $posterior_segment_exam_foveal_reflex_os = $_POST['posterior_segment_exam_foveal_reflex_os'];
    $posterior_segment_exam = $_POST['posterior_segment_exam'];

    // step12 
    $evaluation_impression = $_POST['evaluation_impression'];
    $evaluation_finalrx = $_POST['evaluation_finalrx'];
    $evaluation_referral = $_POST['evaluation_referral'];
    $evaluation_follow_up = $_POST['evaluation_follow_up'];
    $evaluation_external = $_POST['evaluation_external'];
    $evaluation_refraction_obj = $_POST['evaluation_refraction_obj'];
    $evaluation_refraction_subj = $_POST['evaluation_refraction_subj'];
    $evaluation_other_test = $_POST['evaluation_other_test'];
    $evaluation_ass_management = $_POST['evaluation_ass_management'];
    $evaluation_dispensing = $_POST['evaluation_dispensing'];
    $evaluation_supervisor = $_POST['evaluation_supervisor'];

    // Build the SQL query with sanitized values
    $sql = "INSERT INTO test (
        PatientID,
        DoctorID,
        walkin,
        FirstName, 
        LastName, 
        DateOfBirth, 
        Gender, 
        ContactNumber, 
        Occupation, 
        Email, 
        Address, 
        Municipality, 
        City, 
        ZipCode, 
        case_no, 
        co_no, 
        bp_sys, 
        bp_dia, 
        resp_rate, 
        pulse_rate, 
        glasses_od_sph, 
        glasses_od_cyl, 
        glasses_od_add, 
        glasses_os_sph, 
        glasses_os_cyl, 
        glasses_os_add, 
        contact_lens_od, 
        contact_lens_os, 
        type_scl, 
        type_gp, 
        type_toric,

        visual_ocular,
        medical_history_present,
        medical_history_past,
        family_history,
        family_history_ocular,
        family_history_medical,

        visual_acuity_unaided_distance_od,
        visual_acuity_unaided_distance_os,
        visual_acuity_unaided_distance_ou,
        visual_acuity_unaided_near_od,
        visual_acuity_unaided_near_os,
        visual_acuity_unaided_near_ou,
        visual_acuity_pinhole_od,
        visual_acuity_pinhole_os,
        visual_acuity_far_od,
        visual_acuity_far_os,
        visual_acuity_far_ou,
        visual_acuity_near_od,
        visual_acuity_near_os,
        visual_acuity_near_ou,
        pupil_shape_od,
        pupil_shape_os,
        pupil_diameter_od,
        pupil_diameter_os,
        pd,
        de,
        eyes_not_aligned,
        abnormal_head_posture,
        face_tilt_direction,
        head_tilt_direction,
        other_pertinent_observations,
        motor_sensory_push_up_amp,
        motor_sensory_npc,
        motor_sensory_corneal_reflex_od,
        motor_sensory_corneal_reflex_os,
        motor_sensory_alternate_cover_test_far_sc,
        motor_sensory_alternate_cover_test_far_cc,
        motor_sensory_alternate_cover_test_near_sc,
        motor_sensory_alternate_cover_test_near_cc,
        motor_sensory_motility_test_smooth_pursuit,
        motor_sensory_motility_test_saccadic,
        motor_sensory_pupillary_reflex_dlr_od,
        motor_sensory_pupillary_reflex_dlr_os,
        motor_sensory_pupillary_reflex_indirect_od,
        motor_sensory_pupillary_reflex_indirect_os,
        motor_sensory_pupillary_reflex_accommodation_od,
        motor_sensory_pupillary_reflex_accommodation_os,
        motor_sensory_pupillary_reflex_swinging_flashlight_od,
        motor_sensory_pupillary_reflex_swinging_flashlight_os,
        motor_sensory_amsler_test_od,
        motor_sensory_amsler_test_os,
        motor_sensory_proj_test_od,
        motor_sensory_proj_test_os,

        objective_refraction_static_retinoscopy_od,
        objective_refraction_static_retinoscopy_os,
        objective_refraction_dynamic_retinoscopy_od,
        objective_refraction_dynamic_retinoscopy_os,

        subjective_refraction_manifest_mono_od, 
        subjective_refraction_manifest_mono_os,
        subjective_refraction_manifest_bino_od,
        subjective_refraction_manifest_bino_os,
        subjective_refraction_visual_acuity_od,
        subjective_refraction_visual_acuity_os,
        subjective_refraction_visual_acuity_ou,
        subjective_refraction_cycloplegic_od,
        subjective_refraction_cycloplegic_os,
        subjective_refraction_cycloplegic_visual_acuity_od,
        subjective_refraction_cycloplegic_visual_acuity_os,

        phorometric_test_lateral_phoria_20ft_habitual,
        phorometric_test_lateral_phoria_20ft_induced,
        phorometric_test_lateral_phoria_16in_habitual,
        phorometric_test_lateral_phoria_16in_induced,
        phorometric_test_lateral_phoria_16in_induced_13bg,
        phorometric_test_vertical_phoria_20ft,
        phorometric_test_vertical_phoria_16in,
        phorometric_test_duction_20ft,
        phorometric_test_duction_16in,
        vergence_test_bi_20ft,
        vergence_test_bo_20ft,
        vergence_test_bi_16in,
        vergence_test_bo_16in,
        accommodation_test_amp_of_accom,
        accommodation_test_unfussed_crossed_cyl_od,
        accommodation_test_unfussed_crossed_cyl_os,
        accommodation_test_unfussed_crossed_cyl_other,
        accommodation_test_fused_crossed_cyl_od,
        accommodation_test_fused_crossed_cyl_os,
        accommodation_test_fused_crossed_cyl_other,
        accommodation_test_nra_od,
        accommodation_test_nra_os,
        accommodation_test_pra_od,
        accommodation_test_pra_os,

        prism_cover_test_hirschberg,
        hirshberg_test,
        worths_four_dots_far,
        worths_four_dots_near,
        krimsky_test,
        maddox_rod,
        color_vision_ishihara_test,
        color_vision_d15_test,
        visual_field_test_confrontation_od,
        visual_field_test_confrontation_os,
        visual_field_test_ats_od,
        visual_field_test_ats_os,

        trial_framing_distance_od, 
        trial_framing_distance_os, 
        trial_framing_distance_od_over, 
        trial_framing_distance_os_over, 
        trial_framing_add_od, 
        trial_framing_add_os, 
        trial_framing_add_od_over, 
        trial_framing_add_os_over,

                biomicroscopy_eyelids_od,
                biomicroscopy_eyelids_os,
                biomicroscopy_eyelashes_od,
                biomicroscopy_eyelashes_os,
                biomicroscopy_lid_margin_od,
                biomicroscopy_lid_margin_os,
                biomicroscopy_ducts_od,
                biomicroscopy_ducts_os,
                biomicroscopy_conjunctiva_od,
                biomicroscopy_conjunctiva_os,
                biomicroscopy_sclera_od,
                biomicroscopy_sclera_os,
                biomicroscopy_pupil_od,
                biomicroscopy_pupil_os,
                biomicroscopy_iris_od,
                biomicroscopy_iris_os,
                biomicroscopy_lens_od,
                biomicroscopy_lens_os,
                biomicroscopy_other_tests,
                biomicroscopy_von_herrick,
                biomicroscopy_tbut,
                biomicroscopy_schirmers_test,
                biomicroscopy_tear_meniscus,
                biomicroscopy_image,

                intra_ocular_pressure_tactile_od,
                intra_ocular_pressure_tactile_os,
                intra_ocular_pressure_tactile_time_taken,
                intra_ocular_pressure_tactile_time_tested,
                intra_ocular_pressure_tonometry_applanation_od,
                intra_ocular_pressure_tonometry_applanation_os,
                intra_ocular_pressure_tonometry_applanation_time_taken,
                intra_ocular_pressure_tonometry_applanation_time_tested,
                intra_ocular_pressure_icare_od,
                intra_ocular_pressure_icare_os,
                intra_ocular_pressure_icare_time_taken,
                intra_ocular_pressure_icare_os_time_tested,

                posterior_segment_exam_ror_od,
                posterior_segment_exam_ror_os,
                posterior_segment_exam_media_od,
                posterior_segment_exam_media_os,
                posterior_segment_exam_optic_disc_od,
                posterior_segment_exam_optic_disc_os,
                posterior_segment_exam_cd_od,
                posterior_segment_exam_cd_os,
                posterior_segment_exam_av_od,
                posterior_segment_exam_av_os,
                posterior_segment_exam_edema_od,
                posterior_segment_exam_edema_os,
                posterior_segment_exam_hemorrhage_od,
                posterior_segment_exam_hemorrhage_os,
                posterior_segment_exam_exudates_od,
                posterior_segment_exam_exudates_os,
                posterior_segment_exam_cotton_wool_spots_od,
                posterior_segment_exam_cotton_wool_spots_os,
                posterior_segment_exam_foveal_reflex_od,
                posterior_segment_exam_foveal_reflex_os,
                posterior_segment_exam,

                evaluation_impression, 
                evaluation_finalrx, 
                evaluation_referral, 
                evaluation_follow_up, 
                evaluation_external, 
                evaluation_refraction_obj, 
                evaluation_refraction_subj, 
                evaluation_other_test, 
                evaluation_ass_management, 
                evaluation_dispensing, 
                evaluation_supervisor

        
    ) VALUES (
        '$patientId',
        '$doctorId',
        '$walkIn',
        '$firstName',
        '$lastName',
        '$dateOfBirth',
        '$gender',
        '$contactNumber',
        '$occupation',
        '$email',
        '$address',
        '$municipality',
        '$city',
        '$zipCode',
        '$caseNo',
        '$coNo',
        '$bpSys',
        '$bpDia',
        '$respRate',
        '$pulseRate',
        '$glassesOdSph',
        '$glassesOdCyl',
        '$glassesOdAdd',
        '$glassesOsSph',
        '$glassesOsCyl',
        '$glassesOsAdd',
        '$contactLensOd',
        '$contactLensOs',
        '$typeScl',
        '$typeGp',
        '$typeToric',

        '$visualOcular',
        '$medicalHistoryPresent',
        '$medicalHistoryPast',
        '$familyHistory',
        '$familyHistoryOcular',
        '$familyHistoryMedical',

        '$visualAcuityUnaidedDistanceOd',
        '$visualAcuityUnaidedDistanceOs',
        '$visualAcuityUnaidedDistanceOu',
        '$visualAcuityUnaidedNearOd',
        '$visualAcuityUnaidedNearOs',
        '$visualAcuityUnaidedNearOu',
        '$visualAcuityPinholeOd',
        '$visualAcuityPinholeOs',
        '$visualAcuityFarOd',
        '$visualAcuityFarOs',
        '$visualAcuityFarOu',
        '$visualAcuityNearOd',
        '$visualAcuityNearOs',
        '$visualAcuityNearOu',
        '$pupilShapeOd',
        '$pupilShapeOs',
        '$pupilDiameterOd',
        '$pupilDiameterOs',
        '$pd',
        '$de',
        '$eyesNotAligned',
        '$abnormalHeadPosture',
        '$faceTiltDirection',
        '$headTiltDirection',
        '$otherPertinentObservations',
        '$motorSensoryPushUpAmp',
        '$motorSensoryNpc',
        '$motorSensoryCornealReflexOd',
        '$motorSensoryCornealReflexOs',
        '$motorSensoryAlternateCoverTestFarSc',
        '$motorSensoryAlternateCoverTestFarCc',
        '$motorSensoryAlternateCoverTestNearSc',
        '$motorSensoryAlternateCoverTestNearCc',
        '$motorSensoryMotilityTestSmoothPursuit',
        '$motorSensoryMotilityTestSaccadic',
        '$motorSensoryPupillaryReflexDlrOd',
        '$motorSensoryPupillaryReflexDlrOs',
        '$motorSensoryPupillaryReflexIndirectOd',
        '$motorSensoryPupillaryReflexIndirectOs',
        '$motorSensoryPupillaryReflexAccommodationOd',
        '$motorSensoryPupillaryReflexAccommodationOs',
        '$motorSensoryPupillaryReflexSwingingFlashlightOd',
        '$motorSensoryPupillaryReflexSwingingFlashlightOs',
        '$motorSensoryAmslerTestOd',
        '$motorSensoryAmslerTestOs',
        '$motorSensoryProjTestOd',
        '$motorSensoryProjTestOs',

        '$objective_refraction_static_retinoscopy_od',
        '$objective_refraction_static_retinoscopy_os',
        '$objective_refraction_dynamic_retinoscopy_od',
        '$objective_refraction_dynamic_retinoscopy_os',

        '$subjective_refraction_manifest_mono_od',
        '$subjective_refraction_manifest_mono_os',
        '$subjective_refraction_manifest_bino_od',
        '$subjective_refraction_manifest_bino_os',
        '$subjective_refraction_visual_acuity_od',
        '$subjective_refraction_visual_acuity_os',
        '$subjective_refraction_visual_acuity_ou',
        '$subjective_refraction_cycloplegic_od',
        '$subjective_refraction_cycloplegic_os',
        '$subjective_refraction_cycloplegic_visual_acuity_od',
        '$subjective_refraction_cycloplegic_visual_acuity_os',

        '$phorometricTestLateralPhoria20ftHabitual',
        '$phorometricTestLateralPhoria20ftInduced',
        '$phorometricTestLateralPhoria16inHabitual',
        '$phorometricTestLateralPhoria16inInduced',
        '$phorometricTestLateralPhoria16inInduced13BG',
        '$phorometricTestVerticalPhoria20ft',
        '$phorometricTestVerticalPhoria16in',
        '$phorometricTestDuction20ft',
        '$phorometricTestDuction16in',
        '$vergenceTestBi20ft',
        '$vergenceTestBo20ft',
        '$vergenceTestBi16in',
        '$vergenceTestBo16in',
        '$accommodationTestAmpOfAccom',
        '$accommodationTestUnfussedCrossedCylOD',
        '$accommodationTestUnfussedCrossedCylOS',
        '$accommodationTestUnfussedCrossedCylOther',
        '$accommodationTestFusedCrossedCylOD',
        '$accommodationTestFusedCrossedCylOS',
        '$accommodationTestFusedCrossedCylOther',
        '$accommodationTestNraOD',
        '$accommodationTestNraOS',
        '$accommodationTestPraOD',
        '$accommodationTestPraOS',

        '$prism_cover_test_hirschberg',
        '$hirshberg_test',
        '$worths_four_dots_far',
        '$worths_four_dots_near',
        '$krimsky_test',
        '$maddox_rod',
        '$color_vision_ishihara_test',
        '$color_vision_d15_test',
        '$visual_field_test_confrontation_od',
        '$visual_field_test_confrontation_os',
        '$visual_field_test_ats_od',
        '$visual_field_test_ats_os',

            '$trial_framing_distance_od',
            '$trial_framing_distance_os',
            '$trial_framing_distance_od_over',
            '$trial_framing_distance_os_over',
            '$trial_framing_add_od',
            '$trial_framing_add_os',
            '$trial_framing_add_od_over',
            '$trial_framing_add_os_over',

                '$biomicroscopy_eyelids_od',
                '$biomicroscopy_eyelids_os',
                '$biomicroscopy_eyelashes_od',
                '$biomicroscopy_eyelashes_os',
                '$biomicroscopy_lid_margin_od',
                '$biomicroscopy_lid_margin_os',
                '$biomicroscopy_ducts_od',
                '$biomicroscopy_ducts_os',
                '$biomicroscopy_conjunctiva_od',
                '$biomicroscopy_conjunctiva_os',
                '$biomicroscopy_sclera_od',
                '$biomicroscopy_sclera_os',
                '$biomicroscopy_pupil_od',
                '$biomicroscopy_pupil_os',
                '$biomicroscopy_iris_od',
                '$biomicroscopy_iris_os',
                '$biomicroscopy_lens_od',
                '$biomicroscopy_lens_os',
                '$biomicroscopy_other_tests',
                '$biomicroscopy_von_herrick',
                '$biomicroscopy_tbut',
                '$biomicroscopy_schirmers_test',
                '$biomicroscopy_tear_meniscus',
                '$biomicroscopy_image',

                '$intra_ocular_pressure_tactile_od',
                '$intra_ocular_pressure_tactile_os',
                '$intra_ocular_pressure_tactile_time_taken',
                '$intra_ocular_pressure_tactile_time_tested',
                '$intra_ocular_pressure_tonometry_applanation_od',
                '$intra_ocular_pressure_tonometry_applanation_os',
                '$intra_ocular_pressure_tonometry_applanation_time_taken',
                '$intra_ocular_pressure_tonometry_applanation_time_tested',
                '$intra_ocular_pressure_icare_od',
                '$intra_ocular_pressure_icare_os',
                '$intra_ocular_pressure_icare_time_taken',
                '$intra_ocular_pressure_icare_os_time_tested',

                '$posterior_segment_exam_ror_od',
                '$posterior_segment_exam_ror_os',
                '$posterior_segment_exam_media_od',
                '$posterior_segment_exam_media_os',
                '$posterior_segment_exam_optic_disc_od',
                '$posterior_segment_exam_optic_disc_os',
                '$posterior_segment_exam_cd_od',
                '$posterior_segment_exam_cd_os',
                '$posterior_segment_exam_av_od',
                '$posterior_segment_exam_av_os',
                '$posterior_segment_exam_edema_od',
                '$posterior_segment_exam_edema_os',
                '$posterior_segment_exam_hemorrhage_od',
                '$posterior_segment_exam_hemorrhage_os',
                '$posterior_segment_exam_exudates_od',
                '$posterior_segment_exam_exudates_os',
                '$posterior_segment_exam_cotton_wool_spots_od',
                '$posterior_segment_exam_cotton_wool_spots_os',
                '$posterior_segment_exam_foveal_reflex_od',
                '$posterior_segment_exam_foveal_reflex_os',
                '$posterior_segment_exam',

                '$evaluation_impression', 
                '$evaluation_finalrx', 
                '$evaluation_referral', 
                '$evaluation_follow_up', 
                '$evaluation_external', 
                '$evaluation_refraction_obj', 
                '$evaluation_refraction_subj', 
                '$evaluation_other_test', 
                '$evaluation_ass_management', 
                '$evaluation_dispensing', 
                '$evaluation_supervisor'

        
        
    )";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
