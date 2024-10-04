<?php

namespace app\widgets;

use yii\base\Widget;
use yii\bootstrap5\Html;

class Form extends Widget
{

    public $process;
    public $records;
    public function run()
    {
        ob_start(); // Start output buffering

        ?>
        <div class="site-login">
            <?= $this->process ; ?>

            <?php echo "<pre/>";print_r($this->records) ;?>
            <p>Please fill out the following fields to login:</p>
            <div class="row">
                <div class="col-lg-5">
                    <form id="login-form" action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" autofocus>
                            <div class="invalid-feedback">
                                <!-- Error message for username can go here -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <div class="invalid-feedback">
                                <!-- Error message for password can go here -->
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="rememberMe" name="rememberMe" class="form-check-input">
                            <label for="rememberMe" class="form-check-label">Remember me</label>
                            <div class="invalid-feedback">
                                <!-- Error message for rememberMe can go here -->
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" name="login-button">Login</button>
                        </div>
                    </form>

                    <div style="color:#999;" class="mt-3">
                        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
                    </div>
                </div>
            </div>
        </div>
        <?php

        return ob_get_clean(); // Get the output buffer content and return it
    }
}
