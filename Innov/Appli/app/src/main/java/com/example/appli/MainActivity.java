package com.example.appli;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {
    private Button btMots;
    private Button btUser;
    private Button btTrad;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btMots=(Button) findViewById(R.id.btMots);
        btMots.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent intent = new Intent(MainActivity.this, Main3Activity.class)                        ;

                startActivity(intent);

            }
        });


        btUser=(Button) findViewById(R.id.btUser);
        btUser.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent intent = new Intent(MainActivity.this, Main4Activity.class)                        ;

                startActivity(intent);

            }
        });

        btTrad=(Button) findViewById(R.id.btTrad);
        btTrad.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                Intent intent = new Intent(MainActivity.this, Main5Activity.class)                        ;

                startActivity(intent);
            }
        });
    }


}
