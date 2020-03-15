package com.example.appli;

import java.util.Date;

public class User {

    private Integer id;
    private String username;
    private String nom;
    private String prenom;
    private String email;
    private String photo;
    private String nomoriginalphoto;


    public String getNomoriginalphoto() {
        return nomoriginalphoto;
    }

    public void setNomoriginalphoto(String nomoriginalphoto) {
        this.nomoriginalphoto = nomoriginalphoto;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }


    public String getPhoto() {
        return photo;
    }

    public void setPhoto(String photo) {
        this.photo = photo;
    }




}
