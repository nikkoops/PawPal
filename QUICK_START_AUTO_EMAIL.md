# Quick Start Guide: Auto-Generate Email Feature

## 🎯 Feature Summary
System automatically generates email addresses for Shelter Admins based on their name and assigned shelter location.

## 📧 Email Format
```
[first initial][lastname]@[shelterlocation].com
```

## 🚀 Quick Example

### Step-by-Step: Creating Nekeisha Elfa

1. **Navigate to Create Admin**
   ```
   http://localhost:8000/admin/system/users/create
   ```

2. **Enter Full Name**
   ```
   Field: Full Name
   Value: Nekeisha Elfa
   ```

3. **Select Role**
   ```
   Choose: ⚪ System Admin  ✅ Shelter Admin
   ```
   ↓ *Shelter Location dropdown appears*

4. **Select Shelter Location**
   ```
   Dropdown: Manila Shelter
   ```

5. **Email Auto-Generates! ✨**
   ```
   Email field populates: nelfa@manilashelter.com
   Green badge appears: "Auto-generated"
   ```

6. **Fill Remaining Fields**
   ```
   Password: password123
   Confirm Password: password123
   ```

7. **Click "Create Admin"**
   ```
   ✅ Admin created with:
      - Email: nelfa@manilashelter.com
      - Assigned Location: Manila Shelter
   ```

## 🧪 Test Scenarios

### Scenario 1: Muntinlupa Shelter Admin
```
Name: Keisha Martinez
Role: Shelter Admin
Location: Muntinlupa Shelter
Generated Email: kmartinez@muntinlupashelter.com ✓
```

### Scenario 2: Quezon City Shelter Admin
```
Name: John Michael Smith
Role: Shelter Admin
Location: Quezon City Shelter
Generated Email: jsmith@quezonciyshelter.com ✓
```

### Scenario 3: System Admin (No Auto-Gen)
```
Name: Super Admin
Role: System Admin
Location: [dropdown hidden]
Generated Email: [none - manual entry required]
```

## 🔄 Dynamic Behavior

### What Triggers Auto-Generation?
- ✅ Entering/changing the name
- ✅ Selecting/changing shelter location
- ✅ Selecting "Shelter Admin" role

### Manual Override
1. Auto-generated email appears
2. Click on email field
3. Badge disappears
4. Type custom email
5. Submit with custom email ✓

## ✨ Visual Indicators

### When Auto-Generated:
```
┌─────────────────────────────────────────────────┐
│ Email Address *                  [Auto-generated]│
│ ┌───────────────────────────────────────────┐   │
│ │ nelfa@manilashelter.com                   │   │
│ └───────────────────────────────────────────┘   │
│ ✓ Email auto-generated from name and location   │
└─────────────────────────────────────────────────┘
```

### When Manual:
```
┌─────────────────────────────────────────────────┐
│ Email Address *                                  │
│ ┌───────────────────────────────────────────┐   │
│ │ custom@example.com                        │   │
│ └───────────────────────────────────────────┘   │
│ Enter email manually or let it auto-generate    │
└─────────────────────────────────────────────────┘
```

## 🔐 Login After Creation

### Created Admin:
- Email: `nelfa@manilashelter.com`
- Password: `password123`
- Location: Manila Shelter

### Login Process:
1. Go to: http://localhost:8000/login
2. Email: `nelfa@manilashelter.com`
3. Password: `password123`
4. Redirected to: http://localhost:8000/admin/shelter/dashboard
5. Dashboard shows ONLY Manila Shelter data

## 📊 Complete Workflow Diagram

```
System Admin Flow
─────────────────
1. Open Create Admin Page
         ↓
2. Enter: "Nekeisha Elfa"
         ↓
3. Select: "Shelter Admin"
         ↓
4. Select: "Manila Shelter"
         ↓
5. Email Auto-Fills: "nelfa@manilashelter.com"
         ↓
6. Enter Password
         ↓
7. Submit Form
         ↓
8. Admin Created ✓

Shelter Admin Experience
────────────────────────
1. Login: nelfa@manilashelter.com
         ↓
2. Dashboard Loads
         ↓
3. Data Filtered: Manila Shelter ONLY
         ↓
4. Pets: Manila pets only
5. Applications: Manila applications only
6. Analytics: Manila statistics only
```

## 🎨 Name Parsing Examples

| Input Name | First Initial | Last Name | Result |
|------------|---------------|-----------|---------|
| Nekeisha Elfa | n | elfa | nelfa@ |
| John Smith | j | smith | jsmith@ |
| Maria Santos | m | santos | msantos@ |
| Ana Marie Cruz | a | cruz | acruz@ |
| Jose Rizal | j | rizal | jrizal@ |

## 🏢 Location Domain Examples

| Shelter Location | Domain | Full Email Example |
|------------------|--------|-------------------|
| Manila Shelter | manilashelter.com | nelfa@manilashelter.com |
| Quezon City Shelter | quezonciyshelter.com | jsmith@quezonciyshelter.com |
| Makati Shelter | makatishelter.com | msantos@makatishelter.com |
| Muntinlupa Shelter | muntinlupashelter.com | acruz@muntinlupashelter.com |
| Taguig Shelter | taguigshelter.com | jrizal@taguigshelter.com |

## ⚡ Pro Tips

1. **Always enter first and last name** - Single word names won't auto-generate
2. **Select role first** - Location dropdown only appears for Shelter Admins
3. **Watch for green badge** - Confirms successful auto-generation
4. **Override anytime** - Click email field to edit manually
5. **Test login immediately** - Verify email works after creation

## 🐛 Common Issues

### Email Not Generating?
- ✓ Check: Name has at least 2 words
- ✓ Check: Shelter Admin role selected
- ✓ Check: Shelter location selected
- ✓ Try: Refresh page and try again

### Wrong Email Format?
- ✓ Click email field
- ✓ Type correct email manually
- ✓ Form accepts manual entries

### Can't Edit Email?
- ✓ Email field is never locked
- ✓ Just click and type
- ✓ Auto-generated indicator will disappear

## 🎯 Success Criteria

After implementation, verify:
- ✅ Email auto-generates when name + location filled
- ✅ Green "Auto-generated" badge appears
- ✅ Format follows: [initial][lastname]@[location].com
- ✅ Manual override works by clicking field
- ✅ Created admin can login with generated email
- ✅ Dashboard filters data by assigned location

## 📞 Support

For issues or questions:
1. Check console for JavaScript errors
2. Verify form validation passes
3. Clear cache: `docker compose exec app php artisan view:clear`
4. Test in incognito mode to rule out browser cache
5. Check documentation: AUTO_GENERATE_EMAIL_FEATURE.md
