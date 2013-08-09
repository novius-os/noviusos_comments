<?php

echo e(\Cookie::get('comm_email', \Session::get_flash('noviusos_comment::comm_email', '')));
