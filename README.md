# MultiThreadDatabaseProcessing_laravel
Using empty PHP without installing plugins (not pthread) ; Performing process on database rows

The package can only be used in Laravel - Tested on 5.8
The performance is not php artisan serv
step 1 :

create folder (packages/iransoftnet1/multi-thread-database-processing) in root project

step 2:

Copy all contents of the package


step 3:


add namespace in composer.json in root project
```
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Iransoftnet1\\MultiThreadDatabaseProcessing\\":"packages/iransoftnet1/multi-thread-database-processing/src/"
        }
```
step 4:
add provider in config/app.php -> 
```
'providers' => [

 /*
         * Package Service Providers...
         */
        Iransoftnet1\MultiThreadDatabaseProcessing\MainServiceProvider::class,
```

step 5:

enter in consol -> 
```
php artisan vendor:publish --provider=Iransoftnet1\MultiThreadDatabaseProcessing\MainServiceProvider --force
```
step 6:

In the app folder you will see the TaskTable folder _

An example to use
Build everything you have in a class and inherit from the TaskTable class and override the task method

step 7:

Wherever you want to be, just create an object from the class and call the Run method

```

$n = new \App\TaskTable\Notify();

print_r($n->Run());

```



توضیحات فارسی :

گاهی اوقات شما نیاز دارید روی یکسری یا همه ی سطر های یک جدول پایگاه داده یک عملیات محاسباتی تحلیلی و... انجام دهید که سرعت خیلی برای شما مهم است این پکیجی که برای لاراول نوشتم به شما این امکان را می دهد که این کار را انجام دهید

همان طور که می دانید در پی اچ پی عملا مفهموم ترد وجود ندارد و برای استفاده از ترد باید افزونه ی  
pthread
را نصب کنید که خوب این کار روی هاست های رایگان یا اشتراکی امری نادر است .

شما نیاز دارید به چیزی که بدون افزونه این کار را برای شما انجام دهد دقت کنید این پکیج فقط برای انجام کار روی سطح های پایگاه داده است .

با فرض این که پکیج نصب کردید

در پوشه ی 
TaskTable
‌شما هر کاری که دارید یک کلاس می سازید و ارث می برید از کلاس
```
TaskTable
```
داخل پکیج بعد از این کار سه متد

را باید اووراید کنید خوب در اولی معلومه کاری که می خواهید روی دیتا انجام دهید را می گذارید که دیتا کالیکشنی از سطر های جدول مورد نظر شماست
```
function task(Collection $data,$skip): void  
{

}
```
تعداد سطر هایی که می خواهید توی هر ترد انجام شود
```
function setMaxRowInTread(): int  
{  
 return 2;  
}
```
در این جا با کوری بیلدر ها کویری که از جدول مورد نظر می خواهید میسازید و ریترن می کنید
```
function setQueryBuilder(): Builder  
{  
  
}
```
و در اخر هم هر جا نیاز داشتید که انجام عملایات شما شروع شود کافیه از روی این کلاس یک شی بسازید و متد ران ان را فراخوانی کنید مثال این جریان در بخش انگلیسی گفته شده

دقت کنید در
```
php artisan serv
```
کار نمی کنه بلکه باید روی زمپ یا ومپ یا هاست باشد

حتما بعد از نصب دستور زیر را در کنسول وارد کنید تا هم پوشه ی مورد نظر ساخته بشه در اپ هم نمونه مثالی از این کار را مشاهده کنید
```
php artisan vendor:publish --provider=Iransoftnet1\MultiThreadDatabaseProcessing\MainServiceProvider --force
```
