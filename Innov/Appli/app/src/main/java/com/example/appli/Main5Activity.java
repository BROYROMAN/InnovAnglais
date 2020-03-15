package com.example.appli;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.concurrent.ExecutionException;

public class Main5Activity extends AppCompatActivity {

    ListView lvListeTrad;
    ArrayList<Trad> listeTrad;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main5);
        lvListeTrad = (ListView) findViewById(R.id.lvListe5);
        listeTrad = new ArrayList<Trad>();

        try {
            listeTrad = new ListTrad().execute().get();
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }

    }




    @Override
    protected void onResume() {
        super.onResume();
        AdapterTrad adapterTrad = new AdapterTrad(this, listeTrad);
        lvListeTrad.setAdapter(adapterTrad);
    }

}
