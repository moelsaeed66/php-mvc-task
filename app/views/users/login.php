<?php include(VIEWS."inc/header.php");?>

<div class="navbar">
    <?php include(VIEWS."inc/nav.php");?>
</div>

<div class='container-login'>
    <div class="wrapper-login">
        <h2>sign up</h2>

        <form action="<?php echo BURL?>user/login" method='POST'>
        <input type="text" name="username" placeholder="enter username">
        <span class="invalid Feedback">

        <?php echo $data['usernameerror'];?>

        </span>

        <input type="password" name="password" placeholder="enter password">
        <span class="invalid Feedback">

            <?php echo $data['passworderror'];?>
        
        </span>

        <button id="submit" type="submit" value="submit">Submit</button>
        <p class='options'>Not Register Yet? <a href="<?php echo BURL?>user/register">Create account!</a></p>
    
        </form>
    </div>

</div>


<?php include(VIEWS."inc/footer.php");?>