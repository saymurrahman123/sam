<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="sam.css">
  </head>
  <body>
    <script defer src="../control/fun.js"></script>
    <div id="error" style="color: red;"></div> <!-- Fixed typo here -->
  
    <div class="registration-form">
      <h2>User Registration</h2>
      <form  action="connect.php" method = "post" >
        <table>
            <tr>
            <td><label for="username">User Id:</label></td>
            <td>
                  <div class="input-group">
                    <input type="text" id="username" name="username">
                    <span class="error-msg" id="username-error"></span>
            </div>
</td>
</tr>
              
    <tr>
    <td><label for="email">Email:</label></td>
    <td>
<div class="input-group">
    <input type="email" id="email" name="email">
    <span class="error-msg" id="email-error"></span>
</div>
</td>
</tr>
              
     <tr>
    <td><label for="dob">Date of Birth:</label></td>
    <td>
    <div class="input-group">
    <input type="date" id="dob" name="dob">
    <span class="error-msg" id="dob-error"></span>
     </div>
                </td>
     </tr>
              
         <tr>
                <td><label>Gender:</label></td>
                <td>
                <div class="input-group">
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <span class="error-msg" id="gender-error"></span>
                </div>
                </td>
        </tr>
              
        <tr>
                <td><label for="password">Password:</label></td>
                <td>
                <div class="input-group">
                <input type="password" id="password" name="password">
                <span class="error-msg" id="password-error"></span>
                </div>
                </td>
         </tr>
              
        <tr>
            <td><label for="repassword">Re-enter Password:</label></td>
            <td>
            <div class="input-group">
            <input type="password" id="repassword" name="repassword">
            <span class="error-msg" id="repassword-error"></span>
            </div>
            </td>
        </tr>
              
          <tr>
            <td colspan="2" style="text-align: center;">
            <button type="submit">Submit</button>
            </td>
        </tr>
</table>
</form>
 </div>
  </body>
  