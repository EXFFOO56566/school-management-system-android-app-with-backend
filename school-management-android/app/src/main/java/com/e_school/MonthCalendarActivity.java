package com.e_school;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.e_school.calendarUtil.Util;
import com.e_school.calendarUtil.SignListByMonth;
import com.e_school.calendarUtil.OnViewChangeListener;
import com.e_school.calendarUtil.ScrollLayout;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.concurrent.ExecutionException;

import Config.ConstValue;
import util.CommonClass;
import util.JSONParser;
import util.JSONReader;

public class MonthCalendarActivity extends CommonAppCompatActivity implements OnClickListener, OnViewChangeListener, CalendarView.OnItemClickListener {
    private static final String TAG = "MonthCalendarActivity";

    private Map<String, List<SignListByMonth>> mSignListByMonthInfos = new HashMap<String, List<SignListByMonth>>();
    /**
     * Lateral sliding
     */
    private ScrollLayout mScrollLayout;
    private int count;
    /**
     * Custom head
     */
    //private TopBarView mTopBarView;

    private CalendarView calendaLeft;
    private CalendarView calendar;
    private CalendarView calendaRight;
    private ImageButton calendarLeft;
    private TextView calendarCenter;
    private ImageButton calendarRight;
    private String searchDate;
    public String yearAndmonth;
    private int year;
    private int month;
    CommonClass common;
    JSONReader j_reader;
    JSONArray objAttendenceData;
    HashMap<Integer,Integer> attendResult;


    private List<String> signListByMonthList;

    List<Integer> attendance = new ArrayList<>(32);

    List<SignListByMonth> signListByMonthListCopy = new ArrayList<>();
    List<SignListByMonth> signListByMonthListCopy2 = new ArrayList<>();

    private Handler calendarHandler = new Handler() {
        public void handleMessage(Message msg) {
            Bundle bundle = msg.getData();
            Date date = null;
            try {
                SimpleDateFormat format = new SimpleDateFormat("yyyy-mm");
                date = format.parse(bundle.getString("searchDate"));

            } catch (ParseException e) {
                e.printStackTrace();
            }
            calendar.setCalendarData(date);
            signListByMonthList.clear();
            super.handleMessage(msg);
        }
    };

    private String mUsername;
//    private String mName;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_attendence);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = getWindow();
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(getResources().getColor(R.color.color_21));
        }

        common = new CommonClass(this);
        initView();
        initData();
        //Get the calendar middle year and month ya[0] is the year, ya[1] is the month（Format everyone can change it in the calendar control）
        yearAndmonth = calendar.getYearAndmonth();
        String[] ya = yearAndmonth.split("-");
        calendarCenter.setText(ya[0] + "Year" + ya[1] + "Month");

    }

    private void initView() {
        mScrollLayout = (ScrollLayout) findViewById(R.id.scrollLayout);
        count = mScrollLayout.getChildCount();
        Log.d(TAG,"MonthCalendarActivity#count=" + count);
        calendarLeft = (ImageButton) findViewById(R.id.calendarLeft);
        calendarCenter = (TextView) findViewById(R.id.calendarCenter);
        calendarRight = (ImageButton) findViewById(R.id.calendarRight);
        calendar = (CalendarView) findViewById(R.id.calendar);
        calendaLeft = (CalendarView) findViewById(R.id.calendar_left);
        calendaRight = (CalendarView) findViewById(R.id.calendar_right);
        //mTopBarView = (TopBarView) findViewById(R.id.center_top_bar);
        calendaLeft.setOnItemClickListener(this);
        calendar.setOnItemClickListener(this);
        calendaRight.setOnItemClickListener(this);
        calendarLeft.setOnClickListener(this);
        calendarRight.setOnClickListener(this);
        mScrollLayout.SetOnViewChangeListener(this);

    }

    private void initData() {
        /**
         * Get account data
         * */
        mUsername = getIntent().getStringExtra("username");
        //mTopBarView.setTitle("Attendance details");

        signListByMonthList = new ArrayList<>();
        Calendar calendars = Calendar.getInstance();
        year = calendars.get(Calendar.YEAR);
        month = calendars.get(Calendar.MONTH) + 1;
        searchDate = CorrectDate(String.valueOf(year), String.valueOf(month));//把Date型日期变成String  x-y
        attendance.clear();
        signListByMonthListCopy.clear();

        getList(searchDate);
    }


    @Override
    public void onClick(View v) {
        int i = v.getId();
        if (i == R.id.calendarLeft) {
//            getList();
            String leftYearAndmonth;
            Date curDate = StrToDate(yearAndmonth);
            String[] pm = yearAndmonth.split("-");
            Calendar c = Calendar.getInstance();
            int year = c.get(Calendar.YEAR);
            int month = c.get(Calendar.MONTH)+1;

            /*if( year == Integer.parseInt(pm[0]))
            {
                if( month >= 3 && Integer.parseInt(pm[1]) < 4 )
                {
                    Toast.makeText(this, "Previous Year attendance not available", Toast.LENGTH_SHORT).show();
                    return;
                }
            }
            else if( year > Integer.parseInt(pm[0]) && Integer.parseInt(pm[1]) < 4 )
            {
               // calendarLeft.setEnabled(false);
                Toast.makeText(this, "Previous Year attendance not available", Toast.LENGTH_SHORT).show();
                return;
            }*/

            attendance.clear();
            signListByMonthListCopy.clear();
            View rightView = mScrollLayout.getChildAt(2);
            mScrollLayout.removeView(rightView);
            mScrollLayout.addView(rightView, 0);
            calendaLeft = (CalendarView) mScrollLayout.getChildAt(0);
            calendar = (CalendarView) mScrollLayout.getChildAt(1);
            calendaRight = (CalendarView) mScrollLayout.getChildAt(2);
            leftYearAndmonth = calendar.clickLeftMonth(curDate);
            yearAndmonth = leftYearAndmonth;
            String[] ya = leftYearAndmonth.split("-");
            String searchLeftDate = CorrectDate(ya[0], ya[1]);
            calendarCenter.setText(ya[0] + "Year" + ya[1] + "Month");
            //Left slide to get the list data stored in the Map
            List<SignListByMonth> signListByMonthList = mSignListByMonthInfos.get(searchLeftDate);
            if (signListByMonthList != null && signListByMonthList.size() > 0) {
                DateToCalender(signListByMonthList);
            } else { Log.d("hello\n","---"+ya[1]+"---");
                getList(searchLeftDate);
            }
        } else if (i == R.id.calendarRight) {
            attendance.clear();
            //点击下一月
            String rightYearAndmonth;
            String[] pm = yearAndmonth.split("-");
            Calendar c = Calendar.getInstance();
            int year = c.get(Calendar.YEAR);
            int month = c.get(Calendar.MONTH)+1;

            if( year == Integer.parseInt(pm[0]) && month <= Integer.parseInt(pm[1]) )
            {
                Toast.makeText(this, "Attendance not available", Toast.LENGTH_SHORT).show();
                return;
            }
            //Swipe right to delete the leftmost measured view and add a view to the far right
            View leftView = mScrollLayout.getChildAt(0);
            mScrollLayout.removeView(leftView);
            mScrollLayout.addView(leftView, 2);
            calendaLeft = (CalendarView) mScrollLayout.getChildAt(0);
            calendar = (CalendarView) mScrollLayout.getChildAt(1);
            calendaRight = (CalendarView) mScrollLayout.getChildAt(2);
            Date curDate = StrToDate(yearAndmonth);
            rightYearAndmonth = calendar.clickRightMonth(curDate);
            yearAndmonth = rightYearAndmonth;
            String[] ya = rightYearAndmonth.split("-");
            String searchRightDate = CorrectDate(ya[0], ya[1]);
            calendarCenter.setText(ya[0] + "year" + ya[1] + "month");
            //Right slide to get the list data stored in the Map
            List<SignListByMonth> signListByMonthList = mSignListByMonthInfos.get(searchRightDate);
            if (signListByMonthList != null && signListByMonthList.size() > 0) {
                DateToCalender(signListByMonthList);
            } else {
                getList(searchRightDate);
            }
        }
    }

    @Override
    public void OnViewChange(int view) {
        Log.d(TAG,"OnViewChange#view = " + view);
        attendance.clear();
        signListByMonthListCopy.clear();


        if (view == 0) {

            String leftYearAndmonth;
            //Date curDate = StrToDate(yearAndmonth);
            String[] pm = yearAndmonth.split("-");
            Calendar c = Calendar.getInstance();
            int yr = c.get(Calendar.YEAR);
            int mon = c.get(Calendar.MONTH)+1;

            /*if( yr == Integer.parseInt(pm[0]))
            {
                if( mon >= 3 && Integer.parseInt(pm[1]) < 4 )
                {
                    Toast.makeText(this, "Previous Year attendance not available", Toast.LENGTH_SHORT).show();
                    return;
                }
            }
            else if( yr > Integer.parseInt(pm[0]) && Integer.parseInt(pm[1]) < 4 )
            {
                // calendarLeft.setEnabled(false);
                Toast.makeText(this, "Previous Year attendance not available", Toast.LENGTH_SHORT).show();
                return;
            }*/

            //向左滑动,删除最右测得view,在最左侧添加一个view
            View rightView = mScrollLayout.getChildAt(2);
            mScrollLayout.removeView(rightView);
            mScrollLayout.addView(rightView, 0);
            calendaLeft = (CalendarView) mScrollLayout.getChildAt(0);
            calendar = (CalendarView) mScrollLayout.getChildAt(1);
            calendaRight = (CalendarView) mScrollLayout.getChildAt(2);
            String[] yearAndmonths = yearAndmonth.split("-");
            if (!"1".equals(yearAndmonths[1])) {
                int month = Integer.valueOf(yearAndmonths[1]);
                yearAndmonths[1] = String.valueOf(month - 1);
                yearAndmonth = yearAndmonths[0] + "-" + yearAndmonths[1];
            } else {
                yearAndmonths[1] = String.valueOf(12);
                int year = Integer.valueOf(yearAndmonths[0]) - 1;
                yearAndmonths[0] = String.valueOf(year);
                yearAndmonth = yearAndmonths[0] + "-" + yearAndmonths[1];
            }
            calendarCenter.setText(yearAndmonths[0] + "年" + yearAndmonths[1] + "月");
            Date curDate = StrToDate(yearAndmonth);
            calendar.moveToMonth(curDate);
            final String searchMoveLeftDate = CorrectDate(yearAndmonths[0], yearAndmonths[1]);
            //左滑获取存储在Map中的list数据
            List<SignListByMonth> signListByMonthList = mSignListByMonthInfos.get(searchMoveLeftDate);
            if (signListByMonthList != null && signListByMonthList.size() > 0) {
                DateToCalender(signListByMonthList);
            } else {
                getList(searchMoveLeftDate);
            }
        } else if (view == 1) {
            String rightYearAndmonth;
            String[] pm = yearAndmonth.split("-");
            Calendar c = Calendar.getInstance();
            int yr = c.get(Calendar.YEAR);
            int mon = c.get(Calendar.MONTH)+1;

            /*if( yr == Integer.parseInt(pm[0]) && mon <= Integer.parseInt(pm[1]) )
            {
                Toast.makeText(this, "Attendance not available", Toast.LENGTH_SHORT).show();
                return;
            }*/



            String[] yearAndmonths = yearAndmonth.split("-");
            //Swipe right to delete the leftmost measured view and add a view to the far right
            View leftView = mScrollLayout.getChildAt(0);
            mScrollLayout.removeView(leftView);
            mScrollLayout.addView(leftView, 2);
            calendaLeft = (CalendarView) mScrollLayout.getChildAt(0);
            calendar = (CalendarView) mScrollLayout.getChildAt(1);
            calendaRight = (CalendarView) mScrollLayout.getChildAt(2);
            if (!"12".equals(yearAndmonths[1])) {
                int month = Integer.valueOf(yearAndmonths[1]);
                yearAndmonths[1] = String.valueOf(month + 1);
                yearAndmonth = yearAndmonths[0] + "-" + yearAndmonths[1];
            } else {
                yearAndmonths[1] = String.valueOf(1);
                int year = Integer.valueOf(yearAndmonths[0]) + 1;
                yearAndmonths[0] = String.valueOf(year);
                yearAndmonth = yearAndmonths[0] + "-" + yearAndmonths[1];
            }
            calendarCenter.setText(yearAndmonths[0] + "年" + yearAndmonths[1] + "月");
            Date curDate = StrToDate(yearAndmonth);
            calendar.moveToMonth(curDate);
            String searchMoveRightDate = CorrectDate(yearAndmonths[0], yearAndmonths[1]);
            List<SignListByMonth> signListByMonthList = mSignListByMonthInfos.get(searchMoveRightDate);
            //Right slide to get the list data stored in the Map
            if (signListByMonthList != null && signListByMonthList.size() > 0) {
                DateToCalender(signListByMonthList);

            }else {
                getList(searchMoveRightDate);
            }
        }
    }

    public String CorrectDate(String year, String month) {
        String searchDate = "";
        StringBuilder sb = new StringBuilder();
        if (Integer.valueOf(month) < 10) {
            sb.append(year);
            sb.append("-0");
            sb.append(month);
            searchDate = sb.toString();
        } else {
            sb.append(year);
            sb.append("-");
            sb.append(month);
            searchDate = sb.toString();
        }
        return searchDate;
    }

    public static Date StrToDate(String str) {
        SimpleDateFormat format = new SimpleDateFormat("yyyy-MM");
        Date date = null;
        try {
            date = format.parse(str);
        } catch (ParseException e) {
            e.printStackTrace();
        }
        return date;
    }

    public void getList(final String date){
        Intent i = getIntent();
        Bundle bundle = i.getExtras();
        String username = bundle.getString("username");
        DateToCalender(signListByMonthListCopy);

    }

    public void DateToCalender(List<SignListByMonth> signListByMonthList) {
//        getList();
        for (int i = 0; i < 32; i++) {
           // attendance.add(Integer.valueOf(signListByMonthList.get(i).getSignDate().substring(signListByMonthList.get(i).getSignDate().length() - 2, signListByMonthList.get(i).getSignDate().length())));
            attendance.add(i);
        }
        Log.d(TAG,"Attendance: \n" + signListByMonthList);

        try {
            new getAttendenceTask().execute().get();
            //Thread.sleep(90);
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        calendar.setAttendance(attendance, attendResult);
        Log.d(TAG,"MonthCalendarActivity#signListByMonthList= " + signListByMonthList + " " + calendaLeft.getYearAndmonth());
        final String finalSearchDate = searchDate;
        Message message = Message.obtain();
        Bundle bundle = new Bundle();
        bundle.putString("searchDate", finalSearchDate);
        message.setData(bundle);
        calendarHandler.sendMessage(message);
    }

    @Override
    public void OnItemClick(Date downDate) {
        if (Util.isNetWorkAvailable(this)) {
            Log.d(TAG,"MonthCalendarActivity #OnItemClick Date downDate = " + downDate);
            SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
            /*Intent intent = new Intent(this, SignListByDayActivity.class);
            intent.putExtra("inTime", format.format(downDate));
            intent.putExtra("username", mUsername);
            System.out.println(format.format(downDate));
            startActivity(intent);*/
            Toast.makeText(this, "Button click : "+mUsername, Toast.LENGTH_SHORT).show();
        }
    }


    public class getAttendenceTask extends AsyncTask<Void, Void, String> {

        Calendar c = Calendar.getInstance();
        private final ProgressDialog dialog = new ProgressDialog(MonthCalendarActivity.this);
        @Override
        protected  void onPreExecute()
        {
            this.dialog.setMessage("Processing...");
            this.dialog.show();
            Log.e("onPreExecutive","called"+dialog);

        }

        @Override
        protected String doInBackground(Void... params) {

            SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
            String[] pm = calendar.getYearAndmonth().split("-");
            int current_year = Integer.parseInt(pm[0]);
            int current_month = Integer.parseInt(pm[1]);

            // TODO: attempt authentication against a network service.
            String responseString = null;

            List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(2);

            nameValuePairs.add(new BasicNameValuePair("student_id", common.getSession(ConstValue.COMMON_KEY)));
            nameValuePairs.add(new BasicNameValuePair("year", String.valueOf(current_year)));
            nameValuePairs.add(new BasicNameValuePair("month", String.valueOf(current_month)));

            JSONParser jsonParser = new JSONParser();

            try {
                String json_responce = jsonParser.makeHttpRequest(ConstValue.STUDENT_ATTENDENCE_URL, "POST", nameValuePairs);
                Log.e("responce", json_responce);
                JSONObject jObj = new JSONObject(json_responce);
                if (jObj.has("responce") && !jObj.getBoolean("responce")) {
                    responseString = jObj.getString("error");
                } else {
                    if (jObj.has("data")) {
                        objAttendenceData = jObj.getJSONArray("data");
                        attendResult = new HashMap<Integer, Integer>();
                        for (int i = 0; i < objAttendenceData.length(); i++) {
                            JSONObject obj = objAttendenceData.getJSONObject(i);
                            String dayOfWeek[] = obj.getString("attendence_date").split("-");
                            attendResult.put(Integer.parseInt(dayOfWeek[2]), obj.getInt("attended"));
                        }
                    } else {
                        responseString = "User not found";
                    }
                }


            } catch (JSONException e) {
                // TODO Auto-generated catch block
                responseString = e.getMessage();
            } catch (IOException e) {
                // TODO Auto-generated catch block
                responseString = e.getMessage();
                e.printStackTrace();
            }

            // TODO: register the new account here.
            return responseString;
        }

        @Override
        protected void onPostExecute(final String success) {

            this.dialog.dismiss();
            if (success == null) {
                if (objAttendenceData != null) {
                    //note_array.clear();
                    //gridView.setAdapter(adapter);
                }
            } else {
                Toast.makeText(getApplicationContext(), success, Toast.LENGTH_LONG).show();
            }
        }

        @Override
        protected void onCancelled() {
        }
    }
}
