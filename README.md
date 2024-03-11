# Pet_Vaccination_Hub cc

Acest proiect are ca scop gestionarea vaccinurilor destinate animalelor de companie, fiind ideal pentru un cabinet veterinar.
Tehnologiile utilizate: am folosit Html & Css pentru partea de front-end, iar pentru partea de back-end am folosit PHP si MySQL.
Proiectul contine 3 tabele: animale, vaccinuri si administrare_vaccinuri.
In tabelul 'administrare_vaccinuri' am adaugat 2 chei straine pentru id_animal si id_vaccin, ceea ce inseamna ca atunci cand user-ul sterge un animal sau vaccin, se va sterge automat si randul din tabelul 'administrare_vaccinuri' care contine acea data stearsa.
In acest proiect putem gestiona datele din tabele dupa bunul plac, existand operatiunile de adaugare, stergere si afisare a datelor din tabele.
Atribuirea vaccinului dorit pentru un anume animal se face pe baza id-urilor acestora, avand si optiunea de a adauga data la care va avea loc vaccinarea.
In momentul stergerii tuturor elementelor unui tabel se reseteaza incrementul acestuia.
Fiecare operatiune efectuata este insotita de mesaje si afisari menite sa descrie starea actuala a solicitarii tale.
