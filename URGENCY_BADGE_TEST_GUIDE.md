# Urgency Badge - Quick Test Guide

## 🎯 Feature Overview
The urgency badge automatically appears when a pet has been in the shelter for 7+ days, helping admins prioritize long-waiting pets.

---

## 🧪 Testing Steps

### Step 1: Access the Page
Navigate to: **http://localhost:8000/admin/shelter/pets/create**

---

### Step 2: Test Scenarios

#### ✅ Scenario 1: Default (Today's Date)
1. **Action**: Page loads with today's date (10/16/2025)
2. **Expected Result**: ❌ No urgency badge visible
3. **Reason**: Pet just added (0 days)

---

#### ✅ Scenario 2: 6 Days Ago
1. **Action**: Change "Date Added to Shelter" to **10/10/2025**
2. **Expected Result**: ❌ No urgency badge visible  
3. **Reason**: Only 6 days (threshold is 7+)

---

#### ✅ Scenario 3: Exactly 7 Days Ago ⚠️
1. **Action**: Change "Date Added to Shelter" to **10/09/2025**
2. **Expected Result**: ✅ Badge appears: **"🚨 URGENT (7 days)"**
3. **Location**: Top-right of Basic Information card
4. **Style**: Red pill-shaped badge with white text

---

#### ✅ Scenario 4: 8 Days Ago
1. **Action**: Change "Date Added to Shelter" to **10/08/2025**
2. **Expected Result**: ✅ Badge shows: **"🚨 URGENT (8 days)"**
3. **Behavior**: Updates instantly when date changes

---

#### ✅ Scenario 5: 30 Days Ago
1. **Action**: Change "Date Added to Shelter" to **09/16/2025**
2. **Expected Result**: ✅ Badge shows: **"🚨 URGENT (30 days)"**
3. **Priority**: Critical - needs immediate attention

---

#### ✅ Scenario 6: Real-time Update Test
1. **Action**: Start with **10/09/2025** (badge visible)
2. **Action**: Change to **10/11/2025** (6 days ago)
3. **Expected Result**: Badge disappears instantly
4. **Action**: Change back to **10/08/2025** (8 days)
5. **Expected Result**: Badge reappears with "🚨 URGENT (8 days)"

---

#### ✅ Scenario 7: Future Date (Edge Case)
1. **Action**: Change "Date Added to Shelter" to **10/17/2025** (tomorrow)
2. **Expected Result**: ❌ No urgency badge
3. **Reason**: Negative days are ignored

---

## 📊 Visual Reference

### Badge NOT Visible (< 7 days):
```
┌─────────────────────────────────────────────┐
│  Basic Information                          │
│                                             │
│  Pet Name *              Pet Type *         │
│  [Max            ]       [Select type  ▼]   │
└─────────────────────────────────────────────┘
```

### Badge VISIBLE (≥ 7 days):
```
┌─────────────────────────────────────────────┐
│  Basic Information      🚨 URGENT (8 days)  │
│                         └─ Red badge        │
│  Pet Name *              Pet Type *         │
│  [Max            ]       [Select type  ▼]   │
└─────────────────────────────────────────────┘
```

---

## 🎨 UI Specifications

### Badge Design:
- **Background**: Red (`#EF4444`)
- **Text Color**: White
- **Shape**: Rounded pill (`border-radius: 9999px`)
- **Padding**: `16px` horizontal, `6px` vertical
- **Font**: Semi-bold, small size
- **Icon**: 🚨 emoji
- **Position**: Top-right corner of card header

### CSS Classes Used:
```css
.urgency-badge {
    display: hidden;           /* Initially hidden */
    padding: 0.375rem 1rem;   /* py-1.5 px-4 */
    font-size: 0.875rem;      /* text-sm */
    font-weight: 600;         /* font-semibold */
    background-color: #EF4444; /* bg-red-500 */
    color: white;             /* text-white */
    border-radius: 9999px;    /* rounded-full */
}
```

---

## 🔧 Developer Testing

### Console Debugging:
Open browser DevTools and check:

```javascript
// Get the date input value
document.getElementById('date_added').value
// Expected: "2025-10-09" (for 7 days ago)

// Check badge visibility
document.getElementById('urgency-badge').classList.contains('hidden')
// Expected: false (if badge should be visible)

// Get badge text
document.getElementById('urgency-badge').innerHTML
// Expected: "🚨 URGENT (7 days)"
```

### Manual Function Test:
```javascript
// In browser console, trigger manually:
const event = new Event('change');
document.getElementById('date_added').dispatchEvent(event);
// Should update badge immediately
```

---

## ✅ Acceptance Criteria

The feature passes if:

1. ✅ Badge is hidden by default (today's date)
2. ✅ Badge appears when date is 7+ days ago
3. ✅ Badge shows correct day count (e.g., "🚨 URGENT (8 days)")
4. ✅ Badge updates instantly when date changes
5. ✅ Badge style matches screenshot (red, pill-shaped, top-right)
6. ✅ Badge disappears when date is < 7 days ago
7. ✅ No JavaScript errors in console
8. ✅ Works on page load and date selection
9. ✅ Badge positioned correctly on all screen sizes
10. ✅ Future dates don't trigger badge

---

## 📱 Responsive Testing

### Desktop (1920px):
- Badge in top-right corner
- Clear spacing from title
- Readable text size

### Tablet (768px):
- Badge stays top-right
- Text remains visible
- No overflow issues

### Mobile (375px):
- Badge may wrap to second line (acceptable)
- Still clearly visible
- Maintains red color and style

---

## 🐛 Known Issues & Fixes

### Issue: Badge doesn't appear
**Fix**: Check that `date_added` input has correct ID
```html
<input type="date" id="date_added" name="date_added" ...>
```

### Issue: Wrong day count
**Fix**: Ensure timezone is consistent
```javascript
const today = new Date();
today.setHours(0, 0, 0, 0);
```

### Issue: Badge doesn't update
**Fix**: Verify event listeners are attached
```javascript
dateAddedInput.addEventListener('change', checkUrgency);
dateAddedInput.addEventListener('input', checkUrgency);
```

---

## 🎯 Business Value

### Benefits:
1. **Faster Adoptions**: Admins immediately see which pets need priority
2. **Better Resource Allocation**: Focus marketing on urgent pets
3. **Improved Outcomes**: Reduce average shelter stay time
4. **User Experience**: Visual feedback without manual calculation
5. **Data-Driven**: Objective metric (7+ days threshold)

### Success Metrics:
- Reduction in average days per adoption
- Increased visibility for long-waiting pets
- Faster decision-making by shelter staff
- Better tracking of shelter capacity

---

## 📝 Additional Notes

### Calculation Logic:
```
Days in Shelter = Today - Date Added to Shelter

Examples:
- Today: Oct 16, 2025
- Date Added: Oct 9, 2025
- Result: 7 days → URGENT badge appears

- Date Added: Oct 11, 2025  
- Result: 5 days → No badge

- Date Added: Oct 8, 2025
- Result: 8 days → URGENT badge appears
```

### Badge Text Format:
```
🚨 URGENT (X days)

Where X = number of days since date added
```

---

## 🚀 Quick Validation

Run this checklist:
- [ ] Navigate to Add New Pet page
- [ ] Set date to 7 days ago
- [ ] Confirm red badge appears
- [ ] Verify text shows "🚨 URGENT (7 days)"
- [ ] Change date to 5 days ago
- [ ] Confirm badge disappears
- [ ] Test on mobile/tablet view
- [ ] Submit form and verify pet is saved
- [ ] Check no console errors

✅ **All checks passed? Feature is working correctly!**
