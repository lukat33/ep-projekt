package ep.rest;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import okhttp3.Headers;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class BookFormActivity extends AppCompatActivity
        implements View.OnClickListener, Callback<Session> {
    private static final String TAG = BookFormActivity.class.getCanonicalName();

    private EditText email, password, author;
    private Button button;

    private Login login;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_book_form);

        email = (EditText) findViewById(R.id.etEmail);
        password = (EditText) findViewById(R.id.etPassword);
        button = (Button) findViewById(R.id.button);
        button.setOnClickListener(this);
    }

    @Override
    public void onClick(View view) {
        final String loginEmail = email.getText().toString();
        final String loginPassword = password.getText().toString().trim();

        SessionService.getInstance().login(loginEmail, loginPassword).enqueue(this);
    }

    @Override
    public void onResponse(Call<Session> call, Response<Session> response) {
        final Headers headers = response.headers();
        final Session body = response.body();

        if (response.isSuccessful()) {
            Log.i(TAG,response.toString());
        } else {
            Log.e(TAG, "Error");
        }
    }

    @Override
    public void onFailure(Call<Session> call, Throwable t) {
        Log.w(TAG, "Error: " + t.getMessage(), t);
    }
}
