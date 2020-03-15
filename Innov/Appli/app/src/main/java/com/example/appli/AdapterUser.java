package com.example.appli;
import java.util.Date;
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

public class AdapterUser  extends ArrayAdapter<User> {
    Context context;

    public AdapterUser(Context context, ArrayList<User> listeUser) {
        super(context, -1, listeUser);
        this.context = context;
    }


    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View view;

        User unUser;

        view = null;
        if (convertView==null){
            LayoutInflater layoutInflater = (LayoutInflater) this.context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = layoutInflater.inflate(R.layout.liste_ligne_user,parent, false);
        }
        else{
            view = convertView;
        }
        unUser = getItem(position);
        TextView texteListeUser = (TextView) view.findViewById(R.id.texteLigneUser);
        ImageView image = (ImageView) view.findViewById(R.id.imageView);
        byte[] decodedString = Base64.decode(unUser.getPhoto(), Base64.DEFAULT);
        Bitmap bmp = BitmapFactory.decodeByteArray(decodedString, 0, decodedString.length);
        image.setImageBitmap(bmp);
        texteListeUser.setText(unUser.getUsername()+"\n"
                +unUser.getEmail()+"\n"
              );

        return view;
    }

}