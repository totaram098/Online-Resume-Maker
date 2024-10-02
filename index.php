<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link  type="text/css" rel="stylesheet" href="styles.css">
  <title>Online Resume Maker</title>
</head>
<body>

<form method="post" action="">
  <div class="container">
  <h1>Online Resume Maker</h1>
    <label for="">Name:</label>
    <input type="text" name="name" placeholder="Name" ><br>
    <label for="">Email Address:</label>
    <input type="email" name="email" placeholder="Email Address" ><br>
    <label for="">Contact Number:</label>
    <input type="text" name="number" placeholder="Contact Number" ><br>
    <label for="">Residential Address:</label>
    <input type="text" name="address" placeholder="Address" ><br>
    <div id="educationContainer" >
        <label for="">Education:</label>
        <input type="text" name="education" placeholder="Education"><br>
        <label for="">School:</label>
        <input type="text" name="school" placeholder="School" ><br>
        <label for="">Name:</label>
        <div class="date">        
          <input type="date" name="sdate" placeholder="starting Date" >
          <input type="date" name="edate" placeholder="Ending Date" >
        </div>
    </div>     
    <button id="addEducation">Add Education</button></br>
    <label for="">Skill:</label>
    <input type="text" name="skill" placeholder="separate Skills by comma(,) if have more."><br>
    <label for="">Languages:</label>
    <input type="text" name="language" placeholder="separate Languages by comma(,) if have more." ><br>
    <label for="">Hobbies:</label>
    <input type="text" name="hobby" placeholder="separate Hobbies by comma(,) if have more."><br>
    <input type="hidden" id="hidden" value="0" name="totalCount">
    <input type="submit" name="submit" value="Submit">
        
    <div id="buttons" class="hide">
        <a href="resume.pdf" download>Download PDF</a>
        <a href="resume.docx" download>Download DOCX</a>
    </div>
  </div>
</form>

  
<?php
// Check if the form has been submitted
if(isset($_POST['submit'])) {

  // Get the form data
  // $name = $_POST['name'];
  // $email = $_POST['email'];
  // $phone = $_POST['phone'];
  // $experience = $_POST['experience'];
  // $education = $_POST['education'];
  // $skills = $_POST['skills'];

  // Generate the PDF file
  require_once('tcpdf/tcpdf.php');
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // Set the document information
  $pdf->SetCreator('RAM Kumar');
  $pdf->SetAuthor("Totaram");
  $pdf->SetTitle('Resume of ' . "mine");
  $pdf->SetSubject('Resume');

  // Add a page
  $pdf->AddPage();

  // Set the font
  // $pdf->SetFont('times', '', 12);

  // // Add the content
  // $pdf->Cell(0, 10, 'Name: ' . $name, 0, 1);
  // $pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);
  // $pdf->Cell(0, 10, 'Phone: ' . $phone, 0, 1);
  // $pdf->Cell(0, 10, 'Experience: ' . $experience, 0, 1);
  // $pdf->Cell(0, 10, 'Education: ' . $education, 0, 1);
  // $pdf->Cell(0, 10, 'Skills: ' . $skills, 0, 1);
  $htmlSkill = ""; 
  $htmlhobby = ""; 
  $htmllanguage = ""; 
  if($_POST['skill']!="") {
    $skill = explode(",",$_POST['skill']);
    foreach ($skill as $value) {
      $htmlSkill .= '<li><h4>'.$value.'</h4></li>';
    }
  }
  if($_POST['language']!="") {
    $language = explode(",",$_POST['language']);
    foreach ($language as $value) {
      $htmllanguage .= '<li><h4>'.$value.'</h4></li>';
    }
  }
  if($_POST['hobby']!="") {
    $hobby = explode(",",$_POST['hobby']);
    foreach ($hobby as $value) {
      $htmlhobby .= '<li><h4>'.$value.'</h4></li>';
    }
  }
  // Save the PDF file
  $html = '
  <div style="width: 70vw;
      margin: auto;
      color: #2d16b8;
      padding: 20px;
      border-radius: 5px;
      box-shadow:3px 3px 10px, -3px -3px 10px #2d16b8;">
    <h1 style="color: rgb(114, 110, 110);   
      font-size: 25px; 
      margin-top: 10px;
      margin-bottom: 10px;">Personal</h1>
    <h4>'.$_POST['name'].'</h4>
    <h4>'.$_POST['email'].'</h4>
    <h4>'.$_POST['number'].'</h4>
    <h4>'.$_POST['address'].'</h4>
    <hr style="height: 5px;
      color: wheat;
      background-color: whitesmoke;">
    <h1 style="color: rgb(114, 110, 110);   
      font-size: 25px; 
      margin-top: 10px;
      margin-bottom: 10px;">Education</h1>
      <h4>'.$_POST['education'].'</h4>
      <h4>'.$_POST['school'].'</h4>
    <div class="rdate">
      <h4>'.$_POST['sdate'].'  to  '.$_POST['edate'].'</h4>
    </div>
    <hr style="height: 5px;
      color: wheat;
      background-color: whitesmoke;">
    <h1 style="color: rgb(114, 110, 110);   
      font-size: 25px; 
      margin-top: 10px;
      margin-bottom: 10px;">Skills</h1>
    <ul style="padding-left: 40px;">'.$htmlSkill.'
    </ul>
    <hr style="height: 5px;
      color: wheat;
      background-color: whitesmoke;">
    <h1 style="color: rgb(114, 110, 110);   
      font-size: 25px; 
      margin-top: 10px;
      margin-bottom: 10px;">Languages</h1>
    <ul style="padding-left: 40px;">'.$htmllanguage.'
    </ul>
    <hr style="height: 5px;
      color: wheat;
      background-color: whitesmoke;">
    <h1 style="color: rgb(114, 110, 110);   
      font-size: 25px; 
      margin-top: 10px;
      margin-bottom: 10px;">Hobbies</h1>
    <ul style="padding-left: 40px;">'.$htmlhobby.'
    </ul>
    </div>';

  // output the HTML content
  $pdf->writeHTML($html, true, false, true, false, '');

  $pdf->Output(__DIR__.'/resume.pdf', 'F');

  // Generate the DOCX file
  require_once 'PHPWord/vendor/autoload.php';

  $phpWord = new \PhpOffice\PhpWord\PhpWord();

  // Add a section
  $section = $phpWord->addSection();

  
  // Add the content
  $section->addText('Personal ', array('name' => 'Times New Roman', 'size' => 20, 'bold' => true));
  $section->addText($_POST['name'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
  $section->addText($_POST['email'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
  $section->addText($_POST['address'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
  $section->addText($_POST['number'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));

  $section->addLine(array('weight' => 10, 'height' => 0));
  $section->addText('Education ', array('name' => 'Times New Roman', 'size' => 20, 'bold' => true));
  $section->addText($_POST['education'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
  $section->addText($_POST['school'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));

  $section->addText($_POST['sdate'].'  to  '.$_POST['edate'], array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));

  $section->addLine(array('weight' => 10, 'height' => 0));
  $section->addText('Skills ', array('name' => 'Times New Roman', 'size' => 20, 'bold' => true));
  

  if ($_POST['skill']!="") {
    $skill = explode(",",$_POST['skill']);
    foreach ($skill as $value) {
      $section->addText($value, array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
    }
  }
  $section->addLine(array('weight' => 10, 'height' => 0));
  $section->addText('Language ', array('name' => 'Times New Roman', 'size' => 20, 'bold' => true));
  
  if ($_POST['language']!="") {
    $language = explode(",",$_POST['language']);
    foreach ($language as $value) {
      $section->addText($value, array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
    }
  }
  $section->addLine(array('weight' => 10, 'height' => 0));
  $section->addText('Hobbies ', array('name' => 'Times New Roman', 'size' => 20, 'bold' => true));
  
  if ($_POST['hobby']!="") {
    $hobby = explode(",",$_POST['hobby']);
    foreach ($hobby as $value) {
      $section->addText($value, array('name' => 'Times New Roman', 'size' => 14,'color'=>'2d16b8'));
    }
    
  }
//   // Save the DOCX file
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'Word2007');
  $objWriter->save(__DIR__.'/resume.docx');
   
echo "<script>  document.getElementById('buttons').classList.remove('hide');</script>";
}
?>

<!-- HTML form -->

<script>
  var count = 1;
  var element = document.getElementById("addEducation");
  element.addEventListener("click",(e)=>{
    e.preventDefault();
    const newNode = `
        <label for="">Education:</label>
        <input type="text" name="education_`+count+`" placeholder="Education"><br>
        <label for="">School:</label>
        <input type="text" name="school_`+count+`" placeholder="School" ><br>
        <label for="">Name:</label>
        <div class="date">        
          <input type="date" name="sdate_`+count+`" placeholder="starting Date" >
          <input type="date" name="edate_`+count+`" placeholder="Ending Date" >
        </div>`;
    document.getElementById("hidden").value = count;
  var newDiv = document.createElement('div');
  newDiv.id = 'educationContainer';
  newDiv.innerHTML = newNode;
  var parentElement = element.parentElement;
  parentElement.insertBefore(newDiv, element);
  count++;
  })
</script>

</body>
</html>