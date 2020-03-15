# MultiThreadDatabaseProcessing_laravel
Using empty PHP without installing plugins (not pthread) ; Performing process on database rows

The package can only be used in Laravel - Tested on 5.8

step 1 :

create folder (packages/iransoftnet1/multi-thread-database-processing) in root project

step 2:

Copy all contents of the package

step 3:

enter in consol -> php artisan vendor:publish --provider=Iransoftnet1\MultiThreadDatabaseProcessing\MainServiceProvider --force

step 4:

In the app folder you will see the TaskTable folder _

An example to use
Build everything you have in a class and inherit from the TaskTable class and override the task method

step 5:

Wherever you want to be, just create an object from the class and call the Run method

```

$n = new \App\TaskTable\Notify();

print_r($n->Run());

```
