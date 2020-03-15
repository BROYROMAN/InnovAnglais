package com.example.appli;

import android.content.Intent;
import android.os.AsyncTask;
import android.util.Log;

import com.example.appli.Simpleduc;
import com.example.appli.Vocabulaire;

import java.util.ArrayList;

import retrofit.ErrorHandler;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.android.AndroidLog;
import retrofit.client.Response;

public class ListThemes extends AsyncTask<String,Void,ArrayList<Theme>> {
    @Override
    protected ArrayList<Theme> doInBackground(String... strings) {
        Simpleduc simpleduc = new RestAdapter.Builder()
                .setEndpoint(Simpleduc.url)
                .setErrorHandler(new ErrorHandler() {
                    @Override
                    public Throwable handleError(RetrofitError cause) {
                        Response r = cause.getResponse();
                        if (r != null) {
                            Log.d("codeHTTP", String.valueOf(r.getStatus()));

                        }
                        return cause;

                    }
                })
                .setLog(new AndroidLog("retrofit"))
                .setLogLevel(RestAdapter.LogLevel.FULL)
                .build()
                .create(Simpleduc.class);
        ArrayList<Theme> listTheme = simpleduc.listTheme();
        return listTheme;
    }


}
