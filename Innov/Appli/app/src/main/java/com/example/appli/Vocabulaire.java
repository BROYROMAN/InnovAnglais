package com.example.appli;

/**
 * Created by eleve on 12/03/19.
 */
public class Vocabulaire {
    private Integer id;
    private String nom;
    private String libelle;
    private String nomoriginal;

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getNomoriginal() {
        return nomoriginal;
    }

    public void setNomoriginal(String nomoriginal) {
        this.nomoriginal = nomoriginal;
    }
}

