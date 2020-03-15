package com.example.appli;

import java.util.ArrayList;

import retrofit.http.GET;
import retrofit.http.Path;
import retrofit.http.Query;

/**
 * Created by eleve on 12/03/19.
 */
public interface Simpleduc {
    public static final String url = "http://192.168.1.57/InnovAnglais/public";
    @GET("/wsVocabulaire3/{id}")
    ArrayList<Vocabulaire> listVocabulaire (@Path("id") int id);
    @GET("/wsThemes")
    ArrayList<Theme> listTheme();
    @GET("/wsUser")
    ArrayList<User> listUser();
    @GET("/wsTrad")
    ArrayList<Trad> listTrad();
}


