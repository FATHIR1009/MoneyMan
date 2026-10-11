---
name: Autonomous Ledger
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#45464d'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#76777d'
  outline-variant: '#c6c6cd'
  surface-tint: '#565e74'
  primary: '#000000'
  on-primary: '#ffffff'
  primary-container: '#131b2e'
  on-primary-container: '#7c839b'
  inverse-primary: '#bec6e0'
  secondary: '#006c49'
  on-secondary: '#ffffff'
  secondary-container: '#6cf8bb'
  on-secondary-container: '#00714d'
  tertiary: '#000000'
  on-tertiary: '#ffffff'
  tertiary-container: '#07006c'
  on-tertiary-container: '#7073ff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dae2fd'
  primary-fixed-dim: '#bec6e0'
  on-primary-fixed: '#131b2e'
  on-primary-fixed-variant: '#3f465c'
  secondary-fixed: '#6ffbbe'
  secondary-fixed-dim: '#4edea3'
  on-secondary-fixed: '#002113'
  on-secondary-fixed-variant: '#005236'
  tertiary-fixed: '#e1e0ff'
  tertiary-fixed-dim: '#c0c1ff'
  on-tertiary-fixed: '#07006c'
  on-tertiary-fixed-variant: '#2f2ebe'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 30px
    fontWeight: '700'
    lineHeight: 38px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 22px
    fontWeight: '600'
    lineHeight: 30px
    letterSpacing: -0.015em
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 26px
    letterSpacing: -0.01em
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  body-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 18px
  label-lg:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Inter
    fontSize: 11px
    fontWeight: '600'
    lineHeight: 14px
    letterSpacing: 0.03em
  numerical-balance:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.03em
  numerical-ledger:
    fontFamily: Inter
    fontSize: 15px
    fontWeight: '600'
    lineHeight: 22px
    letterSpacing: -0.01em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-mobile: 1rem
  margin: 2rem
  margin-mobile: 1rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2rem
---

## Brand & Style
The design system embodies a modern, disciplined, and frictionless personal wealth tracking environment. Designed for deliberate personal money management across liquid cash, e-wallets, and traditional banking vectors, it blends modern corporate precision with high-craft fintech minimalism.

The visual direction centers on clarity, visual restraint, and structural calm:
- **Atmosphere**: Professional, reassuring, uncluttered, and trustworthy. Numbers and ledger metrics take center stage without visual noise.
- **Design Movement**: Modern Minimalist Fintech with subtle tactile depth. It balances crisp hairline borders, deep navy typography, generous breathable spacing, and soft ambient drop shadows to produce an authoritative yet inviting digital vault.
- **Intent**: Eliminate cognitive fatigue during financial reviews. Status colors (income, expense, and balance-neutral movements) are applied with precision to guide glanceable fiscal comprehension.

## Colors
The palette utilizes deliberate fiscal semantic coding against a cool, structured slate backdrop.

### Core Canvas & Structure
- **Canvas Base**: `#F8FAFC` (Slate 50) provides an airy, anti-glare foundation.
- **Surface Elevation**: `#FFFFFF` (Pure White) serves as the primary card and container base.
- **Subtle Partition**: `#E2E8F0` (Slate 200) defines crisp hairline structure across borders, dividers, and table rows.
- **Primary Navy**: `#0F172A` (Slate 900) anchors all dominant data headers, primary balances, active interactions, and high-contrast buttons. Secondary text transitions smoothly into `#475569` (Slate 600) and muted labels into `#94A3B8` (Slate 400).

### Financial Semantic Indicators
- **Positive Balance & Inflow (Emerald)**: `#10B981` (Emerald 500) paired with `#059669` (Emerald 600) and `#ECFDF5` (Emerald 50) for income indicators, positive deltas, and liquid growth chips.
- **Outflow & Liabilities (Rose/Crimson)**: `#EF4444` (Rose 500) paired with `#E11D48` (Rose 600) and `#FFF1F2` (Rose 50) for immediate, non-alarmist clarity on expenditures and debits.
- **Neutral Inter-Account Transfers (Indigo/Slate)**: `#6366F1` (Indigo 500) and `#475569` (Slate 600) paired with `#EEF2FF` (Indigo 50). This distinct tint signals reallocation between cash, wallets, and bank accounts without creating false impressions of income or net expenditure.

## Typography
Typography is paired strategically: **Plus Jakarta Sans** lends an approachable, modern executive presence to large balances, section headers, and account titles, while **Inter** delivers clinical legibility across dense data tables, transactional meta-information, forms, and small status badges.

Tabular figures (`font-variant-numeric: tabular-nums`) must be enforced on all numeric ledger outputs, currency figures, and time-stamped listings to prevent column shifting during live balance calculations.

## Layout & Spacing
The layout follows a fluid 12-column grid constrained by a maximum desktop width of `1280px` to maintain focused spatial proportions for single-user management.

### Responsive Breakpoints & Adaptations
- **Desktop (>= 1024px)**: 12-column layout with 24px (`1.5rem`) gutters and 32px (`2rem`) outer margin. The primary view splits into a side-anchored summary of account cards (Cash, GoPay, DANA, Banks) spanning 4 columns, alongside an 8-column transactional ledger and trend feed.
- **Tablet (768px - 1023px)**: 8-column layout with 20px gutters. Wallet cards transition into a multi-column horizontal summary grid above the full-width transaction stream.
- **Mobile (< 768px)**: 4-column layout with 16px (`1rem`) gutters and margins. Wallet accounts reflow into an edge-padded horizontal swipe track. Primary inputs and fast-entry triggers reposition to the thumb-accessible bottom viewport edge.

## Elevation & Depth
This design system avoids loud skeuomorphic shadows, relying instead on structural hairline borders paired with ambient, diffused shadows tinted with deep slate tones.

- **Level 0 (Flat Foundation)**: Slate 50 background with no shadow. Structural dividers rely solely on `1px solid #E2E8F0`.
- **Level 1 (Cards & Wallets)**: Pure white `#FFFFFF` surface enclosed in a `1px solid #E2E8F0` border, elevated with an ambient shadow: `0px 1px 3px rgba(15, 23, 42, 0.04), 0px 4px 8px -2px rgba(15, 23, 42, 0.03)`.
- **Level 2 (Hover States & Dropdowns)**: Active ledger rows or interactive wallet cards: `0px 4px 6px -1px rgba(15, 23, 42, 0.06), 0px 10px 15px -3px rgba(15, 23, 42, 0.05)`, with border tint subtly shifting to `#CBD5E1`.
- **Level 3 (Modals & Slide-overs)**: Add-transaction modals, account-linking sheets, and confirm dialogs: `0px 20px 25px -5px rgba(15, 23, 42, 0.08), 0px 8px 10px -6px rgba(15, 23, 42, 0.04)`, rendered atop a soft frosted backdrop (`backdrop-filter: blur(8px); background-color: rgba(15, 23, 42, 0.4)`).

## Shapes
The design uses generous corner curvature to soften structured fiscal data while retaining executive authority.
- Standard inputs, buttons, and badges utilize `rounded-xl` (`0.75rem` to `1rem`).
- Primary wallet containers, modal dialogs, and balance overview cards feature `rounded-2xl` (`1rem` to `1.5rem`).
- Micro indicators, icon badges, and status pills adopt fully rounded geometric contours (`rounded-full`).

## Components

### Wallet Cards
- Dedicated containers for Cash, GoPay, DANA, and Bank accounts.
- Built with `rounded-2xl`, `#FFFFFF` surface, `1px solid #E2E8F0` border, and Level 1 elevation.
- Includes a dedicated brand emblem slot (e.g., stylized GoPay/DANA glyph or bank tag), balance rendered in `headline-md` tabular numbers, account subtype caption in `label-sm` (`#94A3B8`), and a compact status indicator showing the latest reconciliation date.

### Transaction Row / Ledger List
- Enclosed inside card containers with zero internal divider overflow.
- Rows feature a `48px` circular icon container with light tint backgrounds (`#ECFDF5` for income, `#FFF1F2` for expense, `#EEF2FF` for transfer).
- Transaction details show title in `body-md` bold, paired with meta timestamps and source wallet tags in `body-sm` (`#64748B`).
- Amount values are right-aligned:
  - Income: `+#10B981` (Emerald)
  - Expense: `-#EF4444` (Rose)
  - Transfer: `⇄ #6366F1` (Indigo/Slate)

### Buttons
- **Primary Action (Record Entry / Transfer)**: Solid `#0F172A`, text `#FFFFFF`, `rounded-xl`, `h-11`, horizontal padding `1.25rem`. Smooth hover transition to `#1E293B`.
- **Secondary (Export, Filter, Reconcile)**: `#FFFFFF` surface, `1px solid #E2E8F0`, text `#1E293B`, subtle hover background `#F8FAFC`.
- **Quick Action Segmented Controls**: Segmented toggles (Income / Expense / Transfer) built with a `#F1F5F9` track, activating into pure white elevated pills with appropriate semantic typography color when toggled.

### Badges & Status Chips
- Pill-shaped (`rounded-full`), `py-0.5 px-2.5`, strictly paired:
  - Income: `#ECFDF5` background with `#047857` text.
  - Expense: `#FFF1F2` background with `#B91C1C` text.
  - Transfer: `#EEF2FF` background with `#4338CA` text.
  - Neutral / Account: `#F1F5F9` background with `#334155` text.

### Form Inputs & Monetary Fields
- Monetary primary input uses large font scaling (`headline-lg`) centered or left-aligned, prefixed with a static, non-selectable `Rp` marker in `#94A3B8`.
- Standard text, dropdown, and date-picker inputs feature `h-11`, `rounded-xl`, `#FFFFFF` fill, and `1px solid #CBD5E1`. On focus: `border-color: #0F172A` with a soft `0 0 0 3px rgba(15, 23, 42, 0.08)` focus ring.

### Modals & Dialogs
- Max-width `32rem` (`512px`), centered viewport placement, `rounded-2xl`, padded with `1.5rem` (`space-lg`).
- Header includes bold modal title, an interactive close icon button, and structured vertical form fields separated by `1rem` (`space-md`).
- Primary submission actions span full width at the modal base to streamline fast numeric logging.