USERS:
1) user name / password / role: admin / @JRUcZ(%juB!bGQrPm / admin
2) user name / password / role: ipsen / 123456 / seller
3) user name / password / role: fat / 123456 / buyer
//-------------------------------------------------------------

Рецензия ТимЛида на выполнение этого тестового:

Ярослав, добрый день. Тим лид сделал следующие пометки:

- Методы add_role_seller и add_role_buyer следовало вызвать в каком то одном 
методе, который был бы навешан на register_activation_hook.
- Метод передаваемый в register_activation_hook и register_deactivation_hook 
должен быть статическим. 
(https://codex.wordpress.org/Function_Reference/register_activation_hook)
- Указание коллбэка в виде array('MiniShop', 'remove_custom_roles') 
используются исключительно для статических методов.
- Подключение пустого JavaScript файла
- 
https://github.com/velozalet/minishop.loc/blob/master/wp-content/plugins/my_plugin/minishop_lib/Minishop.php#L199-L200 
(Зачем искать термин со слагом 'order_status' и потом без каких либо проверок 
на то что мы что то нашли, использовать полученное значение как родителя 
вставляемых терминов)
- Задание 4 (Добавить 2 роли...) реализовано не верно.
- Пустые <?php ?> тэги.
- get_terms, с версии 4.5.0 параметр $taxonomy больше не используется, ф-ия 
принимает массив параметров, у которых есть значения по умолчанию, поэтому не 
стоит перечислять их все заново.
- 
https://github.com/velozalet/minishop.loc/blob/master/wp-content/themes/my_theme/index.php#L77 
(в теме нет такого шаблона)
- Местами посредственное оформление кода (рекомендуется к прочтению 
http://www.php-fig.org/psr/psr-1/ru/, http://www.php-fig.org/psr/psr-2/ru/).

Оценка 5/10
