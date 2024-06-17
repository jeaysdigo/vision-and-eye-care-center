<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprehensive Eye Examination Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="number"], input[type="date"], textarea { width: 100%; padding: 5px; margin-top: 5px; }
        .form-section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Comprehensive Eye Examination Form</h1>

    <form action="submit_form.php" method="POST">
        <div class="form-section">
            <h2>Patient’s Profile</h2>
            <label>Case No.: <input type="text" name="case_no" required></label>
            <label>CO No: <input type="text" name="co_no" required></label>
            <label>Clinician: <input type="text" name="clinician" required></label>
            <label>Date: <input type="date" name="date" required></label>
            <label>Name: <input type="text" name="name" required></label>
            <label>Age: <input type="number" name="age" required></label>
            <label>Gender: <input type="text" name="gender" required></label>
            <label>Occupation: <input type="text" name="occupation" required></label>
            <label>Address: <textarea name="address" required></textarea></label>
            <label>Contact No.: <input type="text" name="contact_no" required></label>
            <label>Vital signs:</label>
            <label>B.P.: <input type="text" name="bp" required></label>
            <label>Resp. Rate: <input type="text" name="resp_rate" required></label>
            <label>Pulse Rate: <input type="text" name="pulse_rate" required></label>
        </div>

        <div class="form-section">
            <h2>Current Rx</h2>
            <label>Glasses:</label>
            <label>OD: <input type="text" name="glasses_od"></label>
            <label>OS: <input type="text" name="glasses_os"></label>
            <label>Contact Lens:</label>
            <label>OD: <input type="text" name="cl_od"></label>
            <label>OS: <input type="text" name="cl_os"></label>
            <label>Type:</label>
            <label>SCL <input type="checkbox" name="type_scl"></label>
            <label>GP <input type="checkbox" name="type_gp"></label>
            <label>Add: <input type="text" name="add"></label>
            <label>Toric <input type="checkbox" name="toric"></label>
        </div>

        <!-- <div class="form-section">
            <h2>Patient’s History</h2>
            <label>Visual and Ocular: <textarea name="visual_ocular" required></textarea></label>
            <label>Medical:</label>
            <label>Present Illness: <textarea name="present_illness" required></textarea></label>
            <label>Past History: <textarea name="past_history" required></textarea></label>
            <label>Family History:</label>
            <label>Ocular: <textarea name="family_history_ocular" required></textarea></label>
            <label>Medical: <textarea name="family_history_medical" required></textarea></label>
        </div> -->

        <!-- Preliminary Examination and General Observation -->
        <!-- <div class="form-section">
            <h2>Preliminary Examination and General Observation</h2>
            <label>Unaided Distance V.A.</label>
            <label>OD: <input type="text" name="unaided_distance_va_od"></label>
            <label>OS: <input type="text" name="unaided_distance_va_os"></label>
            <label>OU: <input type="text" name="unaided_distance_va_ou"></label>

            <label>Unaided Near V.A.</label>
            <label>OD: <input type="text" name="unaided_near_va_od"></label>
            <label>OS: <input type="text" name="unaided_near_va_os"></label>
            <label>OU: <input type="text" name="unaided_near_va_ou"></label>

            <label>Pinhole Vision</label>
            <label>OD: <input type="text" name="pinhole_vision_od"></label>
            <label>OS: <input type="text" name="pinhole_vision_os"></label>

            <label>V.A with current Rx</label>
            <label>FAR</label>
            <label>OD: <input type="text" name="va_far_od"></label>
            <label>OS: <input type="text" name="va_far_os"></label>
            <label>OU: <input type="text" name="va_far_ou"></label>

            <label>NEAR</label>
            <label>OD: <input type="text" name="va_near_od"></label>
            <label>OS: <input type="text" name="va_near_os"></label>
            <label>OU: <input type="text" name="va_near_ou"></label>
            
            <label>Pupil:</label>
            <label>Shape</label>
            <label>OD: <input type="text" name="pupil_shape_od"></label>
            <label>OS: <input type="text" name="pupil_shape_os"></label>

            <label>Diameter</label>
            <label>OD: <input type="text" name="pupil_diameter_od"></label>
            <label>OS: <input type="text" name="pupil_diameter_os"></label>

            <label>PD: <input type="text" name="pd"></label>
            <label>DE: <input type="text" name="de"></label>
            <label>Eyes not aligned: <input type="checkbox" name="eyes_not_aligned"></label>
            <label>Abnormal Head Posture: <input type="checkbox" name="abnormal_head_posture"></label>
            <label>Face Tilt - Direction: <input type="text" name="face_tilt_direction"></label>
            <label>Head Tilt – Direction: <input type="text" name="head_tilt_direction"></label>
            <label>Other Pertinent Observation: <textarea name="other_pertinent_observation"></textarea></label>
        </div> -->

        <!-- Additional sections follow a similar pattern -->

        <input type="submit" value="Submit">
    </form>
</body>
</html>
