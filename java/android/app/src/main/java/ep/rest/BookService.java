package ep.rest;

import java.util.List;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;
import retrofit2.http.Query;

public class BookService {
    interface RestApi {
        String URL = "http://10.0.2.2:63342/netbeans/ep-projekt/api/";

        @GET("android_api.php")
        Call<List<Book>> getAll();

        @GET("android_api.php")
        Call<Book> get(@Query("id") int id);

        @FormUrlEncoded
        @POST("books")
        Call<Void> insert(@Field("author") String author,
                          @Field("name") String title,
                          @Field("price") double price,
                          @Field("year") int year,
                          @Field("description") String description);

        @FormUrlEncoded
        @PUT("books/{id}")
        Call<Void> update(@Path("id") int id,
                          @Field("author") String author,
                          @Field("name") String title,
                          @Field("price") double price,
                          @Field("year") int year,
                          @Field("description") String description);
    }

    private static RestApi instance;

    public static synchronized RestApi getInstance() {
        if (instance == null) {
            final Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(RestApi.URL)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();

            instance = retrofit.create(RestApi.class);
        }

        return instance;
    }
}
