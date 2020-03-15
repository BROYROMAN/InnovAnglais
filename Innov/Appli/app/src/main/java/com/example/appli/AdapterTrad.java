package com.example.appli;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;


    public class AdapterTrad  extends ArrayAdapter<Trad> {
        Context context;

        public AdapterTrad(Context context, ArrayList<Trad> listeTrad) {
            super(context, -1, listeTrad);
            this.context = context;
        }


        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View view;

            Trad uneTrad ;

            view = null;
            if (convertView==null){
                LayoutInflater layoutInflater = (LayoutInflater) this.context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
                view = layoutInflater.inflate(R.layout.liste_ligne_trad,parent, false);
            }
            else{
                view = convertView;
            }
            uneTrad = getItem(position);
            TextView texteLigneTrad = (TextView) view.findViewById(R.id.texteLigneTrad);

            texteLigneTrad.setText(uneTrad.getTrad() +"\n"
                    +uneTrad.getNom()+"\n"
            );

            return view;
        }

    }

