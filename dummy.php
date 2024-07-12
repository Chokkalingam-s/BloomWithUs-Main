<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease and Therapy Selection</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Disease and Therapy Selection</h2>

        <div class="form-group">
            <label for="diseases">Disease</label>
            <select class="form-control disease-select" id="diseases" multiple="multiple">
                <option>Major Depressive Disorder (MDD)</option>
                <option>Generalized Anxiety Disorder (GAD)</option>
                <option>Panic Disorder</option>
                <option>Social Anxiety Disorder</option>
                <option>Post-Traumatic Stress Disorder (PTSD)</option>
                <option>Obsessive-Compulsive Disorder (OCD)</option>
                <option>Acute Stress Disorder</option>
            </select>
            <div id="selected-diseases" class="selected-items mt-2"></div>
        </div>

        <div class="form-group">
            <label for="therapies">Therapy</label>
            <select class="form-control therapy-select" id="therapies" multiple="multiple">
                <option>Cognitive Behavioural Therapy</option>
                <option>Relaxation Therapy</option>
                <option>Behavioural Therapy</option>
                <option>Art Therapy</option>
                <option>Interpersonal Therapy</option>
                <option>Emotion Focused Therapy</option>
                <option>Family Therapy</option>
            </select>
            <div id="selected-therapies" class="selected-items mt-2"></div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize select2 for disease
        $('.disease-select').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        // Initialize select2 for therapy
        $('.therapy-select').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        // Display selected items as badges
        $('.disease-select').on('change', function() {
            $('#selected-diseases').empty();
            $(this).find('option:selected').each(function() {
                $('#selected-diseases').append('<span class="badge badge-success mr-2">' + $(this).text() + '</span>');
            });
        });

        $('.therapy-select').on('change', function() {
            $('#selected-therapies').empty();
            $(this).find('option:selected').each(function() {
                $('#selected-therapies').append('<span class="badge badge-success mr-2">' + $(this).text() + '</span>');
            });
        });
    });
    </script>
</body>
</html>
