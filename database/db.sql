create database dbcotizacion;
use dbcotizacion;


create table tusuario(
idUsuario char(13) not null,
nombre varchar(100) not null,
correo varchar(200) not null,
contrasenia varchar(255) not null,
apellido varchar(200) not null,
foto varchar(255) ,
rol varchar(255) not null,
dni varchar(8) not null,
estado varchar(20) not null,
created_at datetime not null,
updated_at datetime not null,
primary key (idUsuario) ,
constraint usuario_correo_uindex unique (correo)
)engine=innodb;

create table texcepcion(
idExcepcion char(13) not null,
controlador varchar(100) not null,
funcion varchar(100) not null,
error text not null,
estado varchar(20) not null,
idUsuario varchar(13) ,
created_at datetime not null,
updated_at datetime not null,
primary key (idExcepcion) ,
foreign key (idUsuario) references tusuario (idUsuario)

)engine=innodb;

create table trequerimiento(
idRequerimiento char(13) not null,
idUsuario char(13) not null,
codigo varchar(15) not null,
descripcion varchar(200) not null,
estado varchar(15) not null,
fechaCierre datetime not null,
created_at datetime not null,
updated_at datetime not null,
primary key (idRequerimiento) ,
foreign key (idUsuario) references tusuario (idUsuario),
constraint requerimiento_codigo_uindex unique (codigo)
)engine=innodb;

create table tdocumento(
idDocumento char(13) not null,
idRequerimiento char(13) not null,
nombre varchar(15) not null,
url varchar(255) not null,
created_at datetime not null,
updated_at datetime not null,
primary key (idDocumento) ,
foreign key (idRequerimiento) references trequerimiento (idRequerimiento)
)engine=innodb;

create table tcotizacion(
idCotizacion char(13) not null,
idRequerimiento char(13) not null,
nombre varchar(200) not null,
dni char(8) not null,
tipoPersona varchar(50) not null,
ruc varchar(50) not null,
razonSocial varchar(255) not null,
telefono varchar(20) not null,
correo varchar(100) not null,
asunto varchar(255) not null,
observacion varchar(700) not null,
urlDocumento varchar(255) not null,
estado varchar(20) not null,
created_at datetime not null,
updated_at datetime not null,
primary key (idCotizacion) ,
foreign key (idRequerimiento) references trequerimiento (idRequerimiento)
)engine=innodb;