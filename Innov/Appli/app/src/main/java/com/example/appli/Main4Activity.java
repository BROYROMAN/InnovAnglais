package com.example.appli;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;



import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;


import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.ExecutionException;

public class Main4Activity extends AppCompatActivity {
    ListView lvListeUser;
    ArrayList<User> listeUser;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main4);
        lvListeUser = (ListView) findViewById(R.id.lvListe3);
        listeUser = new ArrayList<User>();

        try {
            listeUser = new ListUsers().execute().get();
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }

    }




    @Override
    protected void onResume() {
        super.onResume();
        AdapterUser adapterUser = new AdapterUser(this, listeUser);
        lvListeUser.setAdapter(adapterUser);
    }



}
