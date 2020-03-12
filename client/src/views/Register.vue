<template>
<div class="Register">
<form method="post" action="register.cgi">

    <h1 style="font-weight: bold;">Register with us & enhance your flavour :P </h1>
    
    <label for="UserName"><b>UserName</b></label> 
    <input type="text" placeholder="Enter UserName" name="UserName" required>
    <br>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
    <br>
    <label for="phone"><b>PhoneNumber</b></label>
    <input type="text" placeholder="Enter PhoneNumber" name="phone" required>
    <br>
    <label for="address"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="address" required>
    <br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="MyPass" required>
    <br>
    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    <br>
    <hr>
    <button type="submit" class="registerbtn">Register</button>
  
  
  
    <p>Already have an account? <a href="/Login.vue">Sign in</a>.</p>
  
 </form>
 </div>
 </template>