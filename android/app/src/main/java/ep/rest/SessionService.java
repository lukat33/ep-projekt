package ep.rest;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import java.util.List;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;


/**
 * Created by andraz on 15/01/2018.
 */

public class SessionService {
    interface RestApi {
        String URL = "http://10.0.2.2:63342/ep-projekt/api/";

        @FormUrlEncoded
        @POST("android_login.php/")
        Call<Session> login(@Field("email") String email, @Field("password") String password);
    }

    private static SessionService.RestApi instance;

    public static synchronized SessionService.RestApi getInstance() {
        if (instance == null) {
            Gson gson = new GsonBuilder()
                    .setLenient()
                    .create();

            final Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(SessionService.RestApi.URL)
                    .addConverterFactory(GsonConverterFactory.create(gson))
                    .build();

            instance = retrofit.create(SessionService.RestApi.class);
        }

        return instance;
    }
}
