create database proyecto;

use proyecto;



create table producto(
	
id int not null auto_increment primary key,

nombre varchar(255),

foto varchar(255),
precio float
);



insert into producto(nombre,foto,precio) value ("Mouse",'/images/mouse.jpg',9);

insert into producto(nombre,foto,precio) value ("Teclado",'/images/teclado.jpg',10);

insert into producto(nombre,foto,precio) value ("CPU",'/images/cpu.jpg',50);

insert into producto(nombre,foto,precio) value ("Monitor",'/images/monitor.jpg',25);

insert into producto(nombre,foto,precio) value ("Altavoces",'/images/altavoces.jpg',11);



create table cliente(

id int not null auto_increment primary key,

correo varchar(255),

fecha_compra datetime not null
);



create table carrito_compra (
	
id int not null auto_increment primary key,

id_producto int not null,

id_cliente int not null,

cantidad float
);

