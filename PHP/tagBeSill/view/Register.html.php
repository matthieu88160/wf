<?php
$title = 'TagBeSill registration';

$content = <<<EOT
    <div class="container">
        <form>
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" />
            </div>
            <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" class="form-control" id="password1">
            </div>
            <div class="form-group">
                <label for="password2">Retype your password</label>
                <input type="password2" class="form-control" aria-describedby="password2Help" id="password2">
                <small id="password2Help" class="form-text text-muted">To be sure you enter a needed password.</small>
            </div>
            <a href="/">
                <button type="button" class="btn btn-success">Back</button>
            </a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
EOT;

include __DIR__ . '/Base.html.php';
