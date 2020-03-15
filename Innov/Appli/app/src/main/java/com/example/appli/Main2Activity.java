package com.example.appli;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;
import android.widget.TextView;


import java.util.ArrayList;
import java.util.concurrent.ExecutionException;

public class Main2Activity extends AppCompatActivity {
    ListView lvListe;
    ArrayList<Vocabulaire> listeVocabulaire;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);
        android.content.Intent intent = getIntent();
        Integer Id = intent.getIntExtra("Id",0);




        lvListe=(ListView) findViewById(R.id.lvListe);
        listeVocabulaire = new ArrayList<Vocabulaire>();
        try {
            listeVocabulaire = new ListVocabulaires(Id).execute().get();
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }


    }

    @Override
    protected void onResume() {
        super.onResume();
        AdapterVocabulaire adapterVocabulaire = new AdapterVocabulaire(this, listeVocabulaire);
        lvListe.setAdapter(adapterVocabulaire);
    }
}
