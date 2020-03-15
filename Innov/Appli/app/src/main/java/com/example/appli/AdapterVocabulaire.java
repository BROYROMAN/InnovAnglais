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

/**
 * Created by eleve on 12/03/19.
 */
public class AdapterVocabulaire extends ArrayAdapter<Vocabulaire> {

    Context context;

    public AdapterVocabulaire(Context context, ArrayList<Vocabulaire> listeVocabulaire) {
        super(context, -1, listeVocabulaire);
        this.context = context;
    }


    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View view;

        Vocabulaire unVocabulaire;

        view = null;
        if (convertView==null){
            LayoutInflater layoutInflater = (LayoutInflater) this.context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = layoutInflater.inflate(R.layout.liste_ligne2,parent, false);
        }
        else{
            view = convertView;
        }
        unVocabulaire = getItem(position);

        TextView texteListe = (TextView) view.findViewById(R.id.texteLigne2);
        ImageView image = (ImageView) view.findViewById(R.id.imageView);
        byte[] decodedString = Base64.decode(unVocabulaire.getNom(), Base64.DEFAULT);
        Bitmap bmp = BitmapFactory.decodeByteArray(decodedString, 0, decodedString.length);
        image.setImageBitmap(bmp);
        texteListe.setText(unVocabulaire.getLibelle());

        return view;
    }


}
