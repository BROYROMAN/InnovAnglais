package com.example.appli;


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

public class Main3Activity extends AppCompatActivity {
    ListView lvListeTheme;
    ArrayList<Theme> listeTheme;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main3);
        lvListeTheme = (ListView) findViewById(R.id.lvListe2);
        listeTheme = new ArrayList<Theme>();
        lvListeTheme.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {


                startViewActivity(position);
            }
        });
        try {
            listeTheme = new ListThemes().execute().get();
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }

    }


    @Override
    protected void onResume() {
        super.onResume();
        AdapterTheme adapterTheme = new AdapterTheme(this, listeTheme);
        lvListeTheme.setAdapter(adapterTheme);
    }
    private void startViewActivity(int position){
        Theme unTheme = listeTheme.get(position);
        Intent intent = new Intent(this, Main2Activity.class);
        intent.putExtra("Id", unTheme.getId());

        startActivity(intent);
    }
}







