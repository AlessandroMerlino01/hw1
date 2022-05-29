CREATE database hw1;
use hw1;

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;


INSERT INTO users(username, password, name, surname, email) VALUES('main','main','main','main','main');



CREATE TABLE contenents (
    id integer primary key auto_increment,
    foto varchar(255) not null,
    titolo varchar(255) not null,
    descrizione text not null
) Engine = InnoDB;

insert into contenents values (1,'./images/submariner.jpg','Submariner','Presentato nel 1953, il Submariner è il primo orologio da polso subacqueo impermeabile fino a 100 metri di profondità. Questo modello rappresenta un eccezionale progresso tecnico in termini di impermeabilità, la seconda rivoluzione in quest’ambito dopo la creazione dell’Oyster, il primo orologio da polso impermeabile della storia, nel 1926.Il Submariner ha costituito una svolta storica nel mondo dell’orologeria, diventando l’archetipo degli orologi subacquei. Oggi il Submariner è impermeabile fino a una profondità di 300 metri.');
insert into contenents values (2,'./images/gmt.jpg','GMT-MASTER II','Progettato per indicare l’ora di due fusi orari simultaneamente, il GMT‑Master, lanciato nel 1955, è nato come strumento di navigazione per i professionisti che girano il mondo. Il GMT‑Master II, erede del modello originale, è stato presentato nel 1982, con un nuovo movimento facile da utilizzare. Ben presto ha conquistato un gran numero di viaggiatori con la sua impareggiabile funzionalità, la sua robustezza e la sua estetica immediatamente riconoscibile.');
insert into contenents values (3, './images/gmt.jpg', 'GMT_MASTER II', 'Progettato per indicare l’ora di due fusi orari simultaneamente, il GMT‑Master, lanciato nel 1955, è nato come strumento di navigazione per i professionisti che girano il mondo.  Il GMT‑Master II, erede del modello originale, è stato presentato nel 1982, con un nuovo movimento facile da utilizzare. Ben presto ha conquistato un gran numero di viaggiatori con la sua impareggiabile funzionalità, la sua robustezza e la sua estetica immediatamente riconoscibile.');

CREATE TABLE contactus (
    id integer primary key auto_increment,
    email varchar(255) not null,
    testo text not null
) Engine = InnoDB;



create Table preferiti(
    id integer primary key auto_increment,
    user integer,
    contenent integer,
    foreign key(user) references users(id),
    foreign key(contenent) references contenents(id),
    unique(user,contenent)

) Engine = InnoDB;

