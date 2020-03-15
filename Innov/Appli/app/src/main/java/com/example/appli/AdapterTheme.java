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

public class AdapterTheme  extends ArrayAdapter<Theme> {
    Context context;

    public AdapterTheme(Context context, ArrayList<Theme> listeTheme) {
        super(context, -1, listeTheme);
        this.context = context;
    }


    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View view;

        Theme unTheme;

        view = null;
        if (convertView==null){
            LayoutInflater layoutInflater = (LayoutInflater) this.context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = layoutInflater.inflate(R.layout.liste_ligne3,parent, false);
        }
        else{
            view = convertView;
        }
        unTheme = getItem(position);
        TextView texteListe3 = (TextView) view.findViewById(R.id.texteLigne3);

        texteListe3.setText(unTheme.getLibelle());
        return view;
    }

}
