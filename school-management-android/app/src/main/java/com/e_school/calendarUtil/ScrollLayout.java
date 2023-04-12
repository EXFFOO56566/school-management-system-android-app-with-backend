package com.e_school.calendarUtil;

import android.content.Context;
import android.util.AttributeSet;
import android.util.Log;
import android.view.MotionEvent;
import android.view.VelocityTracker;
import android.view.View;
import android.view.ViewConfiguration;
import android.view.ViewGroup;
import android.widget.Scroller;


public class ScrollLayout extends ViewGroup {
    private static final String TAG = "ScrollLayout";
    private VelocityTracker mVelocityTracker;// Used to judge the sway gesture
    private Scroller mScroller;// Sliding control
    private int mCurScreen;
    private int mDefaultScreen = 1;
    private float mLastMotionX; //The abscissa of the finger recorded when the finger moves, or when the finger leaves the screen
    private float mLastMotionY; //The abscissa of the finger recorded when the finger moves, or when the finger leaves the screen
    private int mTouchSlop;// Judging criteria for the minimum distance of finger movement
    // In viewpapper, it depends on this value to judge the user.
    // Whether the distance the finger slides reaches the standard of interface sliding
     private static final int SNAP_VELOCITY = 600; // The default scrolling speed, then used to compare the speed of the finger sliding, get the speed of the screen scrolling
     private static final int TOUCH_STATE_REST = 0; // means the touch state is idle, that is, no touch or the finger left
     private static final int TOUCH_STATE_SCROLLING = 1; // means the finger is moving
     private int mTouchState = TOUCH_STATE_REST; // current finger event status
    private String mCurTime;
    private OnViewChangeListener mOnViewChangeListener;

    /**
     * Is the slide done?
     */
    private boolean mCompleted = false;
    /**
     * Direction of sliding
     */
    private int mOrientation = -1; // 0: to the left; 1: to the right

    public ScrollLayout(Context context) {
        super(context);
        Log.i(TAG, "---ScrollLyout1---");
        init(context);
    }

    public ScrollLayout(Context context, AttributeSet attrs) {
        super(context, attrs);
        Log.i(TAG, "---ScrollLyout2---");
        init(context);
    }

    public ScrollLayout(Context context, AttributeSet attrs, int defStyle) {
        super(context, attrs, defStyle);
        Log.i(TAG, "---ScrollLyout3---");
        init(context);
    }

    private void init(Context context) {
        mCurScreen = mDefaultScreen;
        mScroller = new Scroller(context);
        mTouchSlop = ViewConfiguration.get(getContext()).getScaledTouchSlop(); // 使用系统默认的值
    }

    @Override
    protected void onLayout(boolean changed, int l, int t, int r, int b) {
        Log.i(TAG, "---onLayout---");
        // Set their location for each child
        int width = 0;
        int childLeft = 0;
        final int childCount = getChildCount();
        for (int i = 0; i < childCount; i++) {
            final View childView = getChildAt(i);
            if (childView.getVisibility() != View.GONE) {
                // The width obtained here is the value set in onMeasure
                final int childWidth = childView.getMeasuredWidth();
                width = childWidth;
                // Layout for each subview
                childView.layout(childLeft, 0, childLeft + childWidth, childView.getMeasuredHeight());
                childLeft = childLeft + childWidth;
            }
        }
        // Need to test
        scrollTo(mCurScreen * width, 0);
    }

    @Override
    protected void onMeasure(int widthMeasureSpec, int heightMeasureSpec) {
        super.onMeasure(widthMeasureSpec, heightMeasureSpec);
        Log.i(TAG, "---onMeasure---");
        // Execute before onlayout, get the size of the View application, save them, and use them later.
        final int width = MeasureSpec.getSize(widthMeasureSpec);
        final int widthMode = MeasureSpec.getMode(widthMeasureSpec);
        if (widthMode != MeasureSpec.EXACTLY) {
            throw new IllegalStateException(
                    "ScrollLayout only can run at EXACTLY mode!");
        }

        final int hightModed = MeasureSpec.getMode(heightMeasureSpec);
        if (hightModed != MeasureSpec.EXACTLY) {
            throw new IllegalStateException(
                    "ScrollLayout only can run at EXACTLY mode!");
        }

        final int count = getChildCount();
        for (int i = 0; i < count; i++) {
            getChildAt(i).measure(widthMeasureSpec, heightMeasureSpec);
        }

    }

    /**
     * Let the interface follow the finger to the point where the finger moves
     */
    public void snapToDestination() {
        Log.i(TAG, "---snapToDestination---");
        final int screenWidth = getWidth();// The width of the child view, in this case the width of the parent view that he adapted
        Log.i(TAG, "screenWidth = " + screenWidth);
        final int destScreen = (getScrollX() + screenWidth / 2) / screenWidth;// An algorithm
        Log.i(TAG, "[destScreen] : " + destScreen);// getScroolX()Value
        snapToScreen(destScreen);
    }

    /**
     * Scroll to the specified screen
     */
    public void snapToScreen(int whichScreen) {
        Log.i(TAG, "---snapToDestScreen---");
        Log.i(TAG, "Math.min(destScreen, getChildCount() - 1) = " + (Math.min(whichScreen, getChildCount() - 1)));
        whichScreen = Math.max(0, Math.min(whichScreen, getChildCount() - 1));// Get the target screen to scroll to
        Log.i(TAG, "whichScreen = " + whichScreen + " getScrollX = " + getScrollX() + " whichScreen * getWidth() = " + whichScreen * getWidth());
        if (getScrollX() != (whichScreen * getWidth())) {
            final int delta = whichScreen * getWidth() - getScrollX();// How much distance does it take to get the screen to move to the destination view?
            Log.i(TAG, "[getScrollX()] : " + getScrollX());
            Log.i(TAG, "[delta] : " + delta);
            Log.i(TAG, "[getScrollX要走到的位置为] : " + (getScrollX() + delta));
            mScroller.startScroll(getScrollX(), 0, delta, 0, Math.abs(delta) * 2);// Use Scroller to assist scrolling to make scrolling smoother
            mCurScreen = whichScreen;
            invalidate();// Redraw interface
        }
    }

    @Override
    public void computeScroll() {
        Log.i(TAG, "---computeScroll---");
        if (mScroller.computeScrollOffset()) {//computeScrollOffset  The method will always return false, but will return true when the animation finishes executing.
            scrollTo(mScroller.getCurrX(), mScroller.getCurrY());
            postInvalidate();
        } else {
            if (mCompleted) {
                mCompleted = !mCompleted;
                if (mOrientation == 0) { // Left, delete the last view, add to the front
                    int ori = mOrientation;
                    mOrientation = -1;
                    mCurScreen = 1;
                    if (mOnViewChangeListener != null) {
                        mOnViewChangeListener.OnViewChange(ori);
                    }
//                    View view = getChildAt(2);
//                    removeViewAt(2);
//                    addView(view, 0);
                } else if (mOrientation == 1) { //Right, delete the first view, add to the end
                    int ori = mOrientation;
                    mOrientation = -1;
                    mCurScreen = 1;
                    if (mOnViewChangeListener != null) {
                        mOnViewChangeListener.OnViewChange(ori);
                    }
//                    View view = getChildAt(0);
//                    removeViewAt(0);
//                    addView(view);
                }
            }

        }
    }

    @Override
    public boolean onTouchEvent(MotionEvent event) {

        Log.i(TAG, "---onTouchEvent---");
        if (mVelocityTracker == null) {
            mVelocityTracker = VelocityTracker.obtain();
        }
        mVelocityTracker.addMovement(event);
//        removeViewAt(2);
        final int action = event.getAction();
        final float x = event.getX();
        final float y = event.getY();

        switch (action) {
            case MotionEvent.ACTION_DOWN://1, terminate scrolling 2, get the x value of the last event
                Log.i(TAG, "onTouchEvent:ACTION_DOWN");
                if (mVelocityTracker == null) {
                    mVelocityTracker = VelocityTracker.obtain();
                    mVelocityTracker.addMovement(event);
                }
                if (!mScroller.isFinished()) {
                    mScroller.abortAnimation();
                }
                mLastMotionX = x;
                break;
            case MotionEvent.ACTION_MOVE://1,Get the x value of the last event 2, scroll to the specified location
                Log.i(TAG, "onTouchEvent:ACTION_MOVE");
                int deltaX = (int) (mLastMotionX - x);
                if (IsCanMove(deltaX)) {
                    if (mVelocityTracker != null) {
                        mVelocityTracker.addMovement(event);
                    }
                    mLastMotionX = x;
                    scrollBy(deltaX, 0);
                }
                break;
            case MotionEvent.ACTION_UP://1, calculate the speed of the finger movement and get the speed we need 2, choose which screen to scroll to under different circumstances
                Log.i(TAG, "onTouchEvent:ACTION_UP");
                int velocityX = 0;
                if (mVelocityTracker != null) {
                    mVelocityTracker.addMovement(event);
                    mVelocityTracker.computeCurrentVelocity(1000);// Set the property to calculate how many pixels to run in 1 second
                    // computeCurrentVelocity(int units, float maxVelocity)The above 1000 is the units here.
                    // maxVelocity must be positive, indicating maxVelocity when the calculated rate is greater than maxVelocity, and the calculated rate is less than maxVelocity
                    velocityX = (int) mVelocityTracker.getXVelocity();
                    Log.i(TAG, "[velocityX] : " + velocityX);
                }
                if (velocityX > SNAP_VELOCITY && mCurScreen > 0)//If the speed is positive, it means sliding to the right. Need to specify mCurScreen is greater than 0, in order to slide, otherwise it is not accurate
                {
                    // Fling enough to move left
                    Log.i(TAG, "snap left");
                    Log.i(TAG, "Speed is positive and -->: current mCurScreen = " + mCurScreen);

                    mCompleted = true;
                    mOrientation = 0;
                    snapToScreen(mCurScreen - 1);
                } else if (velocityX < -SNAP_VELOCITY && mCurScreen < getChildCount() - 1)//If the speed is negative, it means the finger is sliding to the left. You need to specify that mCurScreen is smaller than the id of the last child view to be able to slide, otherwise it will be inaccurate.
                {
                    // Fling enough to move right
                    Log.i(TAG, "snap right");
                    Log.i(TAG, "Speed is fu and \"--: current mCurScreen = " + mCurScreen);
                    Log.i(TAG, "Going to：mCurScreen = " + (mCurScreen + 1));
                    mCompleted = true;
                    mOrientation = 1;
                    snapToScreen(mCurScreen + 1);
                } else//The speed is less than the speed we have set, so let the interface slide with the finger. Finally, which screen is displayed and then calculated (the method has calculations)
                {
                    Log.i(TAG, "The absolute value of the speed is less than the specified speed, take the snapToDestination method");
                    snapToDestination();
                }
                if (mVelocityTracker != null) {
                    mVelocityTracker.recycle();
                    mVelocityTracker = null;
                }
                //mTouchState = TOUCH_STATE_REST;		//Why are you setting here？？？
                break;
            case MotionEvent.ACTION_CANCEL://1,Set the touch event status to idle
                Log.i(TAG, "onTouchEvent:ACTION_CANCEL");
                mTouchState = TOUCH_STATE_REST;
                break;
            default:
                break;
        }

        return true;
    }

    private boolean IsCanMove(int deltaX) {
        if (getScrollX() <= 0 && deltaX < 0) {
            return false;
        }
        if (getScrollX() >= (getChildCount() - 1) * getWidth() && deltaX > 0) {
            return false;
        }
        return false;
    }

    public void SetOnViewChangeListener(OnViewChangeListener listener) {
        mOnViewChangeListener = listener;
    }

    @Override
    public boolean onInterceptTouchEvent(MotionEvent ev) {
        Log.i(TAG, "---onInterceptTouchEvent---");
        final int action = ev.getAction();
        // 如果
        if ((action == MotionEvent.ACTION_MOVE)
                && mTouchState != TOUCH_STATE_REST) {
            return true;
        }

        final float x = ev.getX();
        final float y = ev.getY();

        switch (action) {
            case MotionEvent.ACTION_DOWN:// Determine if scrolling stops
                Log.i(TAG, "onInterceptTouchEvent:ACTION_DOWN");
                mLastMotionX = x;
                mLastMotionY = y;
                mTouchState = mScroller.isFinished() ? TOUCH_STATE_REST
                        : TOUCH_STATE_SCROLLING;

                break;
            case MotionEvent.ACTION_MOVE:// Determine if the rolling condition is reached
                Log.i(TAG, "onInterceptTouchEvent:ACTION_MOVE");
                final int xDiff = (int) Math.abs(mLastMotionX - x);
                int velocityX = 0;
                if (mVelocityTracker != null) {
                    mVelocityTracker.addMovement(ev);
                    mVelocityTracker.computeCurrentVelocity(1000);// Set the property to calculate how many pixels to run in 1 second
                    // computeCurrentVelocity(int units, float maxVelocity)The above 1000 is the unit here.
                    // maxVelocity must be positive, indicating maxVelocity when the calculated rate is greater than maxVelocity, and the calculated rate is less than maxVelocity
                    velocityX = (int) mVelocityTracker.getXVelocity();
                    Log.i(TAG, "[velocityX] : " + velocityX);
                }
                if (velocityX < -SNAP_VELOCITY && mCurScreen < getChildCount() - 1)//If the speed is negative, it means the finger is sliding to the left. You need to specify that mCurScreen is smaller than the id of the last child view to be able to slide, otherwise it will be inaccurate.
                {
                    // Fling enough to move right
                    mCompleted = true;
                    mOrientation = 1;
                    snapToScreen(mCurScreen + 1);
                }
                if (xDiff > mTouchSlop) {// If the value is greater than the minimum moving distance we specify, the interface is scrolling.
                    mTouchState = TOUCH_STATE_SCROLLING;
                }
                break;
            case MotionEvent.ACTION_UP:// Adjust state to idle
                Log.i(TAG, "onInterceptTouchEvent:ACTION_UP");
                mTouchState = TOUCH_STATE_REST;
                break;

        }
        // If the screen is not scrolling then the touch event is not consumed.
        return mTouchState != TOUCH_STATE_REST;
    }

    public void clickLeftMonth() {
        Log.d(TAG,"clickLeftMonth#mCurScreen = " + mCurScreen);
        mCompleted = true;
        mOrientation = 0;
        snapToScreen(mCurScreen - 1);
    }

    public void clickRightMonth() {
        mCompleted = true;
        mOrientation = 1;
        snapToScreen(mCurScreen + 1);
    }

    public int getmCurScreen() {
        return mCurScreen;
    }
    public String getmCurTime() {
        return mCurTime;
    }

    public void setmCurTime(String mCurTime) {
        this.mCurTime = mCurTime;
    }
}
