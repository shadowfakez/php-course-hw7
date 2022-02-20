# php-course-hw7

ДЗ 7. Builder

Написать построитель запросов на основе шаблона Строитель (Builder) для работы с базой данной.



Level 1.

Написать класс SqlBuilder, реализующий интерфейс SqlBuilderInterface. Данный класс будет позволять строить строку запроса поэтапно, с помощью описанных в интерфейсе методов.

В конце нужно вызывать метод получения результата - в данном интерфейсе это метод build.

Например при вызове такой конструкции

$builder = new QueryBuilder();
$builder->table(‘users’)
    ->select([‘first_name’, ‘age’])
    ->where([‘status’ => ‘active’])
    ->order([‘id’ => ‘ASC’])
    ->limit(20)
    ->offset(40)
    ->build();
Результатом должна быть строка вида 

“SELECT first_name, age FROM users WHERE status = ‘active’ ORDER BY id ASC LIMIT 20 OFFSET 40”





Level 2.

Изменить интерфейс таким образом, чтобы он возращал обьект класса Query. В классе Query реализовать магический метод __toString (или добавить интерфейсный метод типа toSql), который будет собират SQL строку. То есть, делегируем ответственность создания экземпляра класса Query строителю, а приведения к SQL строке - конструируемому обьекту Query.



Т.е. взаимодействие может быть примерно таким:

$builder = new QueryBuilder();
$query = $bulder->table(‘users’)
    ->select([‘first_name’, ‘age’])
    ->where([‘status’ => ‘active’])
    ->order([‘id’ => ‘ASC’])
    ->limit(20)
    ->offset(40)
    ->build();
$sql = (string) $query;




Level 3.

Написать сервис (компонент) Db, который будет уметь получать соединение с базой данных и посылать SQL запросы.

В классе Db реализовать методы one и all. Эти методы получают обьект Query, преобразуют его в sql строку и посылают запрос к БД. Соответственно, эти методы должны возвращать одну запись (в виде обьекта или ассоциативного массива) или коллекцию записей (массив обьектов или ассоциативных массивов) из БД.



Например такой код:

$bulder = new QueryBuilder();
$builder
->table(‘users’)
->select([‘first_name’, ‘age’])
->where([‘id’ => 23])
->build();
И при вызове метода one:

$user = $db->one($query);
результатом должен быть ассоциативный массив вида



[

    ‘first_name’ => ‘Ivan’,

    ‘age’ => 34

]



А при вызове такой конструкции

$users = $db->all($query);
результатом должен быть массив таких пользователей вида



[

    [

        ‘first_name’ => ‘Ivan’,

        ‘age’ => 34

    ],

    [

        ‘first_name’ => ‘Oleg’,

        ‘age’ => 22

    ],

]



P.S. Я добавил пакет с интерфейсами для домашек https://packagist.org/packages/aigletter/interfaces. Это нужно для того, чтобы в случае установки ваших пакетов в мой проект, у нас были совсестимые интерфесы. Можете использовать их в задании. Для текущего задания директория Builder.

По level 1 интерфейс - SqlBuilderInterface, level 2 - QueryBuilderInterface и QueryInterface, по level 2 - еще DbInterface
