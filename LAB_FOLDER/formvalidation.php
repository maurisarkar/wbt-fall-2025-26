<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {
            color: #FF0000;
        }
        .form-section {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <?php
      
      $nameErr = $emailErr = $dobErr = $genderErr = $languagesErr = $bloodErr = "";
      $name = $email = $dd = $mm = $yyyy = $gender = $blood = "";
      $languages = array();
      
      $task1Complete = $task2Complete = $task3Complete = $task4Complete = $task5Complete = $task6Complete = false;
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (isset($_POST["submit1"])) {
          if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            $name = test_input($_POST["name"]);
            
            if (str_word_count($name) < 2) {
              $nameErr = "Name must contain at least two words";
            }
          
            elseif (!preg_match("/^[a-zA-Z]/", $name)) {
              $nameErr = "Name must start with a letter";
            }
            
            elseif (!preg_match("/^[a-zA-Z.\- ]*$/", $name)) {
              $nameErr = "Name can only contain letters, period, dash and spaces";
            } else {
              $task1Complete = true;
            }
          }
        }
        
       
        if (isset($_POST["submit2"])) {
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } else {
            $email = test_input($_POST["email"]);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
            } else {
              $task2Complete = true;
            }
          }
        }
        
       
        if (isset($_POST["submit3"])) {
          if (empty($_POST["dd"]) || empty($_POST["mm"]) || empty($_POST["yyyy"])) {
            $dobErr = "Date of birth is required";
          } else {
            $dd = test_input($_POST["dd"]);
            $mm = test_input($_POST["mm"]);
            $yyyy = test_input($_POST["yyyy"]);
            
           
            if (!is_numeric($dd) || $dd < 1 || $dd > 31) {
              $dobErr = "Day must be between 1 and 31";
            }
           
            elseif (!is_numeric($mm) || $mm < 1 || $mm > 12) {
              $dobErr = "Month must be between 1 and 12";
            }
            
            elseif (!is_numeric($yyyy) || $yyyy < 1953 || $yyyy > 1998) {
              $dobErr = "Year must be between 1953 and 1998";
            }
            
            elseif (!checkdate($mm, $dd, $yyyy)) {
              $dobErr = "Invalid date";
            } else {
              $task3Complete = true;
            }
          }
        }
        
        
        if (isset($_POST["submit4"])) {
          if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
          } else {
            $gender = test_input($_POST["gender"]);
            $task4Complete = true;
          }
        }
        
        
        if (isset($_POST["submit5"])) {
          if (empty($_POST["languages"])) {
            $languagesErr = "Please select at least two languages";
          } else {
            $languages = $_POST["languages"];
            if (count($languages) < 2) {
              $languagesErr = "Please select at least two languages";
            } else {
              $task5Complete = true;
            }
          }
        }
        
       
        if (isset($_POST["submit6"])) {
          if (empty($_POST["blood"]) || $_POST["blood"] == "") {
            $bloodErr = "Blood group is required";
          } else {
            $blood = test_input($_POST["blood"]);
            $task6Complete = true;
          }
        }
      }
      
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>
    
    <h2>PHP Form Validation Lab Tasks</h2>
    <p><span class="error">* required field</span></p>
    
    
    <div class="form-section">
        <h3>Task 1: Name</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            <input type="submit" name="submit1" value="Submit">
            <p style="font-size: 12px;">Rules: Cannot be empty, at least two words, must start with a letter, can contain a-z, A-Z, period, dash only</p>
        </form>
        <?php if($task1Complete) { echo "<p style='color: green;'><strong>Name:</strong> " . $name . "</p>"; } ?>
    </div>
    
    
    <div class="form-section">
        <h3>Task 2: Email</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>E-mail:</label>
            <input type="text" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            <input type="submit" name="submit2" value="Submit">
            <p style="font-size: 12px;">Rules: Cannot be empty, must be a valid email address</p>
        </form>
        <?php if($task2Complete) { echo "<p style='color: green;'><strong>Email:</strong> " . $email . "</p>"; } ?>
    </div>
    
    
    <div class="form-section">
        <h3>Task 3: Date of Birth</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Date of Birth:</label>
            DD: <input type="text" name="dd" size="2" value="<?php echo $dd;?>">
            MM: <input type="text" name="mm" size="2" value="<?php echo $mm;?>">
            YYYY: <input type="text" name="yyyy" size="4" value="<?php echo $yyyy;?>">
            <span class="error">* <?php echo $dobErr;?></span>
            <br><br>
            <input type="submit" name="submit3" value="Submit">
            <p style="font-size: 12px;">Rules: Cannot be empty, dd: 1-31, mm: 1-12, yyyy: 1953-1998</p>
        </form>
        <?php if($task3Complete) { echo "<p style='color: green;'><strong>Date of Birth:</strong> " . $dd . "/" . $mm . "/" . $yyyy . "</p>"; } ?>
    </div>
    
    
    <div class="form-section">
        <h3>Task 4: Gender</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Gender:</label>
            <input type="radio" name="gender" value="male" <?php if($gender=="male") echo "checked";?>>Male
            <input type="radio" name="gender" value="female" <?php if($gender=="female") echo "checked";?>>Female
            <input type="radio" name="gender" value="other" <?php if($gender=="other") echo "checked";?>>Other
            <span class="error">* <?php echo $genderErr;?></span>
            <br><br>
            <input type="submit" name="submit4" value="Submit">
            <p style="font-size: 12px;">Rules: At least one must be selected</p>
        </form>
        <?php if($task4Complete) { echo "<p style='color: green;'><strong>Gender:</strong> " . $gender . "</p>"; } ?>
    </div>
    
    
    <div class="form-section">
        <h3>Task 5: Languages</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Languages:</label>
            <input type="checkbox" name="languages[]" value="English" <?php if(in_array("English", $languages)) echo "checked";?>>English
            <input type="checkbox" name="languages[]" value="Bengali" <?php if(in_array("Bengali", $languages)) echo "checked";?>>Bengali
            <input type="checkbox" name="languages[]" value="Hindi" <?php if(in_array("Hindi", $languages)) echo "checked";?>>Hindi
            <input type="checkbox" name="languages[]" value="Arabic" <?php if(in_array("Arabic", $languages)) echo "checked";?>>Arabic
            <span class="error">* <?php echo $languagesErr;?></span>
            <br><br>
            <input type="submit" name="submit5" value="Submit">
            <p style="font-size: 12px;">Rules: At least two must be selected</p>
        </form>
        <?php if($task5Complete) { echo "<p style='color: green;'><strong>Languages:</strong> " . implode(", ", $languages) . "</p>"; } ?>
    </div>
    
   
    <div class="form-section">
        <h3>Task 6: Blood Group</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Blood Group:</label>
            <select name="blood">
                <option value="">-- Select Blood Group --</option>
                <option value="A+" <?php if($blood=="A+") echo "selected";?>>A+</option>
                <option value="A-" <?php if($blood=="A-") echo "selected";?>>A-</option>
                <option value="B+" <?php if($blood=="B+") echo "selected";?>>B+</option>
                <option value="B-" <?php if($blood=="B-") echo "selected";?>>B-</option>
                <option value="O+" <?php if($blood=="O+") echo "selected";?>>O+</option>
                <option value="O-" <?php if($blood=="O-") echo "selected";?>>O-</option>
                <option value="AB+" <?php if($blood=="AB+") echo "selected";?>>AB+</option>
                <option value="AB-" <?php if($blood=="AB-") echo "selected";?>>AB-</option>
            </select>
            <span class="error">* <?php echo $bloodErr;?></span>
            <br><br>
            <input type="submit" name="submit6" value="Submit">
            <p style="font-size: 12px;">Rules: Must be selected</p>
        </form>
        <?php if($task6Complete) { echo "<p style='color: green;'><strong>Blood Group:</strong> " . $blood . "</p>"; } ?>
    </div>
</body>
</html>