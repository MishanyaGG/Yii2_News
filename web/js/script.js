// Значения категорий
var kat = document.getElementById('create_kat');
// Кнопка при открытии формы добавления категории
var btn_create = document.getElementById('create_btn_kat');
// Кнопка для закрытия формы
var btn_close = document.getElementById('btn_close');

// Значения категорий
var kat_del = document.getElementById('del_kat');
// Кнопка при открытии формы удаления категории
var btn_del = document.getElementById('del_btn_kat');
// Кнопка для закрытия формы
var btn_close_del = document.getElementById('btn_close_del');

// Значения категорий
var kat_edit = document.getElementById('edit_kat');
// Кнопка при открытии формы изменения категории
var btn_edit = document.getElementById('edit_btn_kat');
// Кнопка для закрытия формы
var btn_close_edit = document.getElementById('btn_close_edit');

// Значения основных категорий
var kategori = document.getElementById('kategori');

// Скрываем по умолчанию формы
kat.style.display = 'none';
kat_del.style.display = 'none';
kat_edit.style.display = 'none';

// Открываем форму для добавления категории
btn_create.addEventListener('click',function (){
    kat.style.display = '';
    btn_create.style.display = 'none';
    btn_del.style.display = 'none';
    kategori.style.display = 'none';
    btn_edit.style.display = 'none';
});

// Закрываем форму для добавления категории
btn_close.addEventListener('click',function (){
    kat.style.display = 'none';
    btn_create.style.display = '';
    btn_del.style.display = '';
    kategori.style.display = 'flex';
    btn_edit.style.display = '';
});

// Открываем форму для удаления категории
btn_del.addEventListener('click',function (){
   kat_del.style.display = '';
   btn_del.style.display = 'none';
   btn_create.style.display = 'none';
   kategori.style.display = 'none';
   btn_edit.style.display = 'none';
});

// Закрываем форму для удаления категории
btn_close_del.addEventListener('click',function (){
    kat_del.style.display = 'none';
    btn_del.style.display = '';
    btn_create.style.display = '';
    kategori.style.display = 'flex';
    btn_edit.style.display = '';
});

// Открываем форму для изменения категории
btn_edit.addEventListener('click',function (){
    kat_edit.style.display = '';
    btn_create.style.display = 'none';
    btn_del.style.display = 'none';
    kategori.style.display = 'none';
    btn_edit.style.display = 'none';
});

// Закрываем форму для изменения категории
btn_close_edit.addEventListener('click',function (){
    kat_edit.style.display = 'none';
    btn_create.style.display = '';
    btn_del.style.display = '';
    kategori.style.display = 'flex';
    btn_edit.style.display = '';
})