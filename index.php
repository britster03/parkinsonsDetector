<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logos/logo.png" type="image/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include "nav.html";  ?>

    <div id="inp-flex">
        <div class="inp-wrapper">
            <div class="inp-container">
                <h1>Upload a file here</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="upload-container">
                        <div class="border-container">
                            <label for="upload" id="drop-area">
                                <input type="file" name="file" accept=".jpg, .png" id="upload" hidden>
                                <img id="preview" src="" alt="Preview"
                                    style="display:none; max-width:100%; max-height:100%;">
                                <div id="drop-area-text">
                                    <p>Drag and drop image here.</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    <input type="submit" id="submit" name="submit">
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('drop-area').addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        document.getElementById('drop-area').addEventListener('dragleave', function (e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        document.getElementById('drop-area').addEventListener('drop', function (e) {
            e.preventDefault();
            this.classList.remove('dragover');
            var file = e.dataTransfer.files[0];
            var uploadInput = document.getElementById('upload');
            uploadInput.files = e.dataTransfer.files;
            var dropAreaText = document.getElementById('drop-area-text');
            dropAreaText.innerHTML = '<p>File selected: ' + file.name + '</p>';

            var preview = document.getElementById('preview');
            preview.style.display = 'inline-block';
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        });
    </script>

    <?php
    if (isset($_POST['submit'])) {
    
        $img = 'test.jpg';

        move_uploaded_file($_FILES['file']['tmp_name'], $img);

        $command = "python predict.py " . escapeshellarg($img);
        $output = shell_exec($command);
        if ($output == "1") {
            echo "<div id='pred-wrapper'>
            <p class='disease-note'><b>NOTE: This information is not a substitute for professional medical advice. Please consult a neurologist for an accurate diagnosis.</b></p>
            
            <h1 id='disease-title'>Parkinson's Disease: Causes, Symptoms, and Treatment</h1>
            
            <p class='disease-para'>Parkinson's Disease (PD) is a progressive neurological disorder that affects movement. It develops gradually, and its symptoms worsen over time. PD is characterized by the loss of dopamine-producing cells in the brain.</p>
            
            <b class='disease-consult'>If you suspect you may have Parkinson's Disease, it is crucial to consult a neurologist or a healthcare professional specializing in neurodegenerative disorders for a thorough evaluation and appropriate guidance.</b>
            
            <h2 id='disease-subtitle'>Causes of Parkinson's Disease</h2>
            
            <p class='disease-para'>The exact cause of PD is not known, but it is thought to involve a combination of genetic and environmental factors. Some cases are believed to be hereditary, while others may result from exposure to certain toxins or environmental triggers.</p>
            
            <h2 id='disease-subtitle'>Symptoms of Parkinson's Disease</h2>
            
            <p class='disease-para'>Common symptoms of PD include:</p>
            
            <ul class='disease-para'>
                <li>Tremors or shaking, especially in the hands</li>
                <li>Bradykinesia (slowness of movement)</li>
                <li>Stiffness in limbs</li>
                <li>Impaired balance and coordination</li>
                <li>Difficulty initiating and controlling movements</li>
                <li>Speech changes, such as softening or slurring</li>
                <li>Reduced facial expression (masked face)</li>
            </ul>
            
            <div class='disease-image'>
                <img class='disease-img' src='assets\disease image\parkinsons.jpg' alt='Parkinson's Disease'>
            </div>
            
            <h2 id='disease-subtitle'>Treatment Options</h2>
            
            <p class='disease-para'>While there is no cure for Parkinson's Disease, several treatment options aim to manage symptoms and improve quality of life:</p>
            
            <ul class='disease-para'>
                <li>Medications to increase dopamine levels or mimic its effects</li>
                <li>Physical therapy and exercise to enhance mobility and flexibility</li>
                <li>Surgery, such as deep brain stimulation, in advanced cases</li>
                <li>Speech therapy and occupational therapy</li>
                <li>Symptomatic treatments for specific symptoms</li>
            </ul>
            
            <p class='disease-para'>Individuals with PD should collaborate closely with their healthcare providers to create a personalized treatment plan tailored to their needs.</p>
            
            <h2 id='disease-subtitle'>Conclusion</h2>
            
            <p class='disease-para'>Parkinson's Disease poses significant challenges, but with proper diagnosis and management, individuals can maintain a good quality of life. Early intervention and a multidisciplinary approach involving healthcare professionals can make a positive impact. If you suspect you may have PD or experience related symptoms, seek medical advice promptly for an accurate evaluation.</p>
            
            <p class='disease-para'>Remember, this blog post is for informational purposes only and should not be considered as medical advice. Always consult with a qualified healthcare provider for proper diagnosis and treatment.</p>
        </div>
        ";


        }else {
            echo "<div id='pred-wrapper'>
            <h1 id='disease-title'>No Disease detected</h1>
            </div>";
        }

        echo "<script>window.location.href = '#pred-wrapper';</script>";
    }
    ?>


</body>

</html>