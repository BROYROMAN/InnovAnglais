package com.example.appli;

import android.os.AsyncTask;
import android.util.Log;

import java.util.ArrayList;

import retrofit.ErrorHandler;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.android.AndroidLog;
import retrofit.client.Response;

public class ListUsers extends AsyncTask<String,Void,ArrayList<User>> {
    @Override
    protected ArrayList<User> doInBackground(String... strings) {
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
        ArrayList<User> listUser = simpleduc.listUser();
        return listUser;
    }
}
