<?php

// Classe abstraite Employe
abstract class Employe
{
    protected $nom;
    protected $salaire;

    public function __construct($nom, $salaire)
    {
        $this->nom = $nom;
        $this->salaire = $salaire;
    }

    abstract public function calculerSalaire(); // Méthode abstraite à implémenter dans les classes dérivées

    public function afficherDetails()
    {
        echo "Nom : " . $this->nom . "\n";
        echo "Salaire : " . $this->calculerSalaire() . "\n";
    }
}

// Classe EmployeTempsPlein héritant de la classe Employe
class EmployeTempsPlein extends Employe
{
    protected $tauxHoraire;
    protected $heuresTravaillees;

    public function __construct($nom, $tauxHoraire, $heuresTravaillees)
    {
        parent::__construct($nom, 0);
        $this->tauxHoraire = $tauxHoraire;
        $this->heuresTravaillees = $heuresTravaillees;
    }

    public function calculerSalaire()
    {
        return $this->tauxHoraire * $this->heuresTravaillees;
    }
}

// Interface Contrat
interface Contrat
{
    public function calculerPrime();
}

// Classe EmployeContratTemporaire héritant de la classe Employe et implémentant l'interface Contrat
class EmployeContratTemporaire extends Employe implements Contrat
{
    protected $salaireMensuel;

    public function __construct($nom, $salaireMensuel)
    {
        parent::__construct($nom, 0);
        $this->salaireMensuel = $salaireMensuel;
    }

    public function calculerSalaire()
    {
        return $this->salaireMensuel;
    }

    public function calculerPrime()
    {
        return $this->salaireMensuel * 0.05; // Prime de 5% du salaire mensuel
    }
}

// Utilisation des classes et interfaces

// Employé à temps plein
$employeTempsPlein = new EmployeTempsPlein("Jean Dupont", 15, 40);
$employeTempsPlein->afficherDetails();

// Employé en contrat temporaire
$employeContratTemporaire = new EmployeContratTemporaire("Alice Martin", 2000);
$employeContratTemporaire->afficherDetails();
echo "Prime : " . $employeContratTemporaire->calculerPrime() . "\n";