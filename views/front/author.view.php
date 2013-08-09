<?php

echo e(\Cookie::get('comm_author', \Session::get_flash('noviusos_comment::comm_author', '')));
