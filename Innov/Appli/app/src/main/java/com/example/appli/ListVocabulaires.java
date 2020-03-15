package com.example.appli;

import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.ListView;

import java.util.ArrayList;

import retrofit.ErrorHandler;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.android.AndroidLog;
import retrofit.client.Response;

/**
 * Created by eleve on 12/03/19.
 */
public class ListVocabulaires extends AsyncTask<String,Void,ArrayList<Vocabulaire>> {
    private int id;


    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public ListVocabulaires(int id) {


        this.id = id;
    }

    @Override
    protected ArrayList<Vocabulaire> doInBackground(String... strings) {
        Simpleduc simpleduc = new RestAdapter.Builder()
                .setEndpoint(Simpleduc.url)
                .setErrorHandler(new ErrorHandler() {
                    @Override
                    public Throwable handleError(RetrofitError cause) {
                        Response r = cause.getResponse();
                        if (r != null){
                            Log.d("codeHTTP", String.valueOf(r.getStatus()));

                        }
                        return cause;

                    }
                })
                .setLog(new AndroidLog("retrofit"))
                .setLogLevel(RestAdapter.LogLevel.FULL)
                .build()
                .create(Simpleduc.class);

        ArrayList<Vocabulaire> listVocabulaire = simpleduc.listVocabulaire(id);
        return listVocabulaire;
    }


}