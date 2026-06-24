@echo off
echo Fixing Portfolio title...
echo @extends('layouts.frontend') > temp.txt
echo @section('title', 'Portfolio') >> temp.txt
more +2 resources\views\frontend\portfolio\index.blade.php >> temp.txt
move /y temp.txt resources\views\frontend\portfolio\index.blade.php > nul

echo Fixing Services title...
echo @extends('layouts.frontend') > temp.txt
echo @section('title', 'Services') >> temp.txt
more +2 resources\views\frontend\services\index.blade.php >> temp.txt
move /y temp.txt resources\views\frontend\services\index.blade.php > nul

echo Fixing Contact title...
echo @extends('layouts.frontend') > temp.txt
echo @section('title', 'Contact') >> temp.txt
more +2 resources\views\frontend\contact.blade.php >> temp.txt
move /y temp.txt resources\views\frontend\contact.blade.php > nul

echo Clearing cache...
php artisan optimize:clear

echo DONE! Titles updated successfully.
pause